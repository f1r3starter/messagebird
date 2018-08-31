<?php

namespace Application\Workers;

use Application\Exceptions\NetworkException;
use Application\Workers\Interfaces\LoopProceeder;
use Application\Workers\Interfaces\Worker;

class SocketServer implements Worker
{
    protected $socket;
    protected $read;
    protected $write;
    protected $except;
    protected $clients;
    protected $connection;
    protected $dataProceeder;

    public function __construct(string $address = '127.0.0.1', int $port = 1234, LoopProceeder $dataProceeder, int $backlog = 5)
    {
        if (($this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
            throw new NetworkException('Socket creation failed. reason: ' . socket_strerror(socket_last_error()) . PHP_EOL);
        }

        if (socket_bind($this->socket, $address, $port) === false ||
            socket_listen($this->socket, $backlog) === false
        ) {
            throw new NetworkException('Socket failed. reason: ' . socket_strerror(socket_last_error($this->socket)) . "\n");
        }

        $this->clients = array($this->socket);

        $this->write = null;
        $this->except = null;

        $this->dataProceeder = $dataProceeder;
    }

    public function __destruct()
    {
        if (is_resource($this->socket)) {
            $this->stopServer();
        }
    }

    public function start(): string
    {
        try {
            while (true) {
                $this->dataProceeder->proceedBackground();
                if ($this->socketSelect()) {
                    continue;
                }
                if ($this->acceptConnection()) {
                    $this->socketSelect();
                    try {
                        $data = $this->readData();
                        if ($data) {
                            $this->dataProceeder->readData(json_decode($data, true));
                            $this->sendData($this->dataProceeder->giveResponse());
                            if ($this->dataProceeder->stopLoop()) {
                                $this->stopServer();
                                break;
                            }
                        }
                    } catch (\InvalidArgumentException $exception) {
                        $this->sendData($exception->getMessage() . PHP_EOL);
                    } catch (\Exception $exception) {
                        $this->sendData($exception->getMessage() . PHP_EOL);
                    }
                }
            }
            $this->stopServer();
        } catch (NetworkException $exception) {
            return $exception->getMessage();
        } catch (\TypeError $exception) {
            return $exception->getMessage();
        }
        return 'end' . PHP_EOL;
    }

    protected function socketSelect(): bool
    {
        $this->read = $this->clients;
        $this->write = null;
        $this->except = null;
        return socket_select($this->read, $this->write, $this->except, 5) < 1;
    }

    protected function acceptConnection(): bool
    {
        if (in_array($this->socket, $this->read)) {
            if (($newConnection = socket_accept($this->socket)) === false) {
                throw new NetworkException('Socket acception failed. reason: ' . socket_strerror(socket_last_error($this->socket)) . PHP_EOL);
            }
            $this->clients[] = $this->connection = $newConnection;
            $key = \array_search($this->socket, $this->read, true);
            unset($this->read[$key]);
            return true;
        }
        return false;
    }

    protected function readData(): string
    {
        $data = false;
        foreach ($this->read as $read) {
            $data = socket_read($read, 4096, PHP_BINARY_READ);
            if ($data !== false) {
                $this->connection = $read;
                return $data;
            } else {
                $this->removeSocket($read);
                $this->closeConnection();
            }
            continue;
        }
        return $data;
    }

    protected function sendData($message): void
    {
        socket_write($this->connection, $message, strlen($message));
        $this->closeConnection();
    }

    protected function removeSocket($socket): void
    {
        $key = array_search($socket, $this->clients);
        unset($this->clients[$key]);
    }

    protected function closeConnection(): void
    {
        $this->removeSocket($this->connection);
        socket_close($this->connection);
    }

    protected function stopServer(): void
    {
        socket_close($this->socket);
    }
}
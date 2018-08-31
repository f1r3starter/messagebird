<?php

namespace Application\Workers;

use Application\Workers\Interfaces\LoopProceeder;
use Application\Workers\Interfaces\Worker;

class FileReader implements Worker
{
    protected $file;
    protected $dataProceeder;

    public function __construct(string $filename, LoopProceeder $dataProceeder)
    {
        $this->dataProceeder = $dataProceeder;
        $this->file = $filename;

    }

    public function start(): string
    {
        try {
            while (true) {
                $this->dataProceeder->proceedBackground();
                if ($this->dataProceeder->stopLoop()) {
                    break;
                }
                $tempName = $this->file . random_int(1, 100000);
                if (file_exists($this->file) && rename($this->file, $tempName)) {
                    foreach ($this->readFile($tempName) as $lineData) {
                        $this->dataProceeder->readData($lineData);
                    }
                    unlink($tempName);
                }
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return 'end' . PHP_EOL;
    }

    private function readFile($fileName)
    {
        $file = fopen($fileName, 'rb');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                yield json_decode($line, true);
            }
            fclose($file);
        }
    }
}
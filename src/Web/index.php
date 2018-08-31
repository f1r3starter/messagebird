<?php

require(__DIR__ . '/../../vendor/autoload.php');

use Application\Bootstrap\Bootstrap;
use Application\Helpers\Validators\PhoneValidation;

class MainController
{
    public function serve()
    {
        if ($_POST) {
            if (!isset($_POST['message'], $_POST['phone'])) {
                return 'Both message and phone parameters should be specified';
            } elseif (!(new PhoneValidation($_POST['phone']))->isValid()) {
                return 'Specified phone has an invalid format';
            } else {
                Bootstrap::proceedData(
                    [
                        'phone' => $_POST['phone'],
                        'message' => $_POST['message'],
                        'time' => time()
                    ]
                );
                return 'Message were sent (maybe)';
            }
        } else {
            return 'Please, send phone and message parameters';
        }
    }
}

echo json_encode(['response' => (new MainController())->serve()]);
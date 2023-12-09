<?php
namespace App\Controller;
class ControllerConfig{
    public function __construct(string $controller){
        //Swtich case de 
        switch ($controller) {
            case 'ControllerInvoice':
                return new ControllerInvoice();
                break;
            case 'ControllerBatch':
                return new ControllerBatch();
                break;
            case 'ControllerEntrance':
                return new ControllerEntrance();
                break;
            case 'ControllerEntrance':
                return new ControllerEntrance();
                break;
            case 'ControllerOutput':
                return new ControllerOutput();
                break;
            case 'ControllerProduct':
                return new ControllerProduct();
                break;
        }
    }
        
}
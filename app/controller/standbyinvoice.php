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
namespace App\Controller;

class ControllerConfig {
    private $controllerInstance;

    public function __construct(string $controller) {
        $this->controllerInstance = $this->getControllerInstance($controller);
    }

    private function getControllerInstance(string $controller) {
        switch ($controller) {
            case 'ControllerInvoice':
                return new ControllerInvoice();
            case 'ControllerBatch':
                return new ControllerBatch();
            case 'ControllerEntrance':
                return new ControllerEntrance();
            case 'ControllerOutput':
                return new ControllerOutput();
            case 'ControllerProduct':
                return new ControllerProduct();
            default:
                // Lógica para lidar com casos não previstos, por exemplo, lançar uma exceção ou retornar um valor padrão.
                return null;
        }
    }

    public function __call($method, $args) {
        if (method_exists($this->controllerInstance, $method)) {
            return call_user_func_array([$this->controllerInstance, $method], $args);
        } else {
            // Lógica para lidar com métodos não existentes no controlador.
            // Por exemplo, lançar uma exceção ou retornar um valor padrão.
            return null;
        }
    }
}

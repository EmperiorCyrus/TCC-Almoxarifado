<?php
  //require
  require_once 'vendor/autoload.php';
  //use
  use App\Model\DTO\BatchDTO;
  use App\Model\DTO\CategoryDTO;
  use App\Model\DTO\EntranceDTO;
  use App\Model\DTO\InvoiceDTO;
  use App\Model\DTO\LoanDTO;
  use App\Model\DTO\ProductDTO;
  use App\Model\DTO\requesterDTO;

	// Define as rotas
	$routes = [
		'ControllerInvoice' => [
			'index'  => ['action' => 'index',  'view' => 'note/index'],
			'save'   => ['action' => 'save',   'view' => 'note/save'],
			'edit'   => ['action' => 'edit',   'view' => 'note/edit'],
			'delete' => ['action' => 'delete', 'view' => 'note/delete'],
		],
	];

	//exit(var_dump($routes));

	// Obtém o controlador e a ação
	$controller = $_REQUEST['controller'];
	$action = $_REQUEST['action'];

	// Verifica se a rota existe
	if (!isset($routes[$controller])) {
		
		//Fazer um pagina html de solicitações ou acesso inválido
		die('Rota não encontrada.');
	} else if (!isset($routes[$controller][$action])) {
		die('Ação não encontrada.');
	}


	// Obtém a view
	$view = $routes[$controller][$action]['view'];

	// Instancia o controlador
	$controller = new $controller(); // new ControllerInvoice();
	// Prepara o DTO
	$dto = str_replace("Controller", "", $_REQUEST['controller']);    
	$dto.='DTO';        

	//Analisa o que é necessário executar
	switch ($action) {
		case 'save':     
			switch ($dto) {
				case 'InvoiceDTO':
					$note = new InvoiceDTO($_REQUEST['numero'],$_REQUEST['path'],$_REQUEST['description']);
					//$controller->$action($note);
					// Exibe a view
					include_once '../app/view/' . $view . '.php';
					break;
			}
				break;
		case 'index':
			$result = $controller->$action();
			include_once '../app/view/' . $view . '.php';
				
		default:
		
			break;
	}


<?php
  //require
  require_once __DIR__.'/vendor/autoload.php';
  //use
  use App\Controller\ControllerConfig;  

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
		'ControllerBatch' => [
			'index'  => ['action' => 'index',  'view' => 'note/index'],
			'save'   => ['action' => 'save',   'view' => 'note/save'],
			'edit'   => ['action' => 'edit',   'view' => 'note/edit'],
			'delete' => ['action' => 'delete', 'view' => 'note/delete'],
		],
		'ControllerEntrance' => [
			'index'  => ['action' => 'index',  'view' => 'note/index'],
			'save'   => ['action' => 'save',   'view' => 'note/save'],
			'edit'   => ['action' => 'edit',   'view' => 'note/edit'],
			'delete' => ['action' => 'delete', 'view' => 'note/delete'],
		],
		'ControllerProduct' => [
			'index'  => ['action' => 'index',  'view' => 'note/index'],
			'save'   => ['action' => 'save',   'view' => 'note/save'],
			'edit'   => ['action' => 'edit',   'view' => 'note/edit'],
			'delete' => ['action' => 'delete', 'view' => 'note/delete'],
		],
		'ControllerOutput' => [
			'index'  => ['action' => 'index',  'view' => 'note/index'],
			'save'   => ['action' => 'save',   'view' => 'note/save'],
			'edit'   => ['action' => 'edit',   'view' => 'note/edit'],
			'delete' => ['action' => 'delete', 'view' => 'note/delete'],
		],
	];


	
	$controller = trim($_REQUEST['controller'], "'");				// Armazena dados _REQUEST e garante dados sem aspas simples (');
	$action 		= trim($_REQUEST['action'], "'");						// **


// Verifica se a rota condiz com os controllers
if (!isset($routes[$controller])) {	
	header("Location: app/view/error404.php");							// Redireciona para a página de erro 404
	exit(); 																								// Encerra o script após o redirecionamento

// Verifica se a rota condiz com as ações
} else if (!isset($routes[$controller][$action])) {
	header("Location: app/view/error404.php");							// Redireciona para a página de erro 404
	exit(); 																								// Encerra o script após o redirecionamento
}



	$view = $routes[$controller][$action]['view'];					// Obtem rota relacionado aos _REQUEST  e armazena em array.

	$controller = new ControllerConfig($controller);				// Instancia o controlador dinamicamente.

	$dto = str_replace("Controller", "", $_REQUEST['controller']);    // Remove inicio da string.
	$dto.='DTO';																											// Adiciona DTO no final do que sobrou da string
	$dto = str_replace("'", "", $dto);																// Garante que a string não terá aspas.
      
	//Analisa o que é necessário executar
	switch ($action) {

		case 'save':     
			switch ($dto) {
				
				case 'InvoiceDTO':
					//$note = new InvoiceDTO($_REQUEST['numero'],$_REQUEST['path'],$_REQUEST['description']);
					$note = new InvoiceDTO(555,"teste","teste");
					include_once 'app/view/' . $view . '.php';
					break;

				case 'BatchDTO':
					//$note = new BatchDTO($_REQUEST['idnota'],$_REQUEST['codigo']);
					$note = new BatchDTO(1,"555", null, null);
					
			}
				break;
		case 'index':
			switch ($dto) {

				
			}
				
		default:
		
			break;
	}


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


	// Matriz para definições de rotas
	$routes = [
		'ControllerInvoice' => [
			'index'  => ['action' => 'index',  'view' => 'note/index'],
			'save'   => ['action' => 'save',   'view' => 'note/save'],
			'edit'   => ['action' => 'edit',   'view' => 'note/edit'],
			'delete' => ['action' => 'delete', 'view' => 'note/delete'],
		],
		'ControllerBatch' => [
			'index'  => ['action' => 'index',  'view' => 'batch/index'],
			'save'   => ['action' => 'save',   'view' => 'batch/save'],
			'edit'   => ['action' => 'edit',   'view' => 'batch/edit'],
			'delete' => ['action' => 'delete', 'view' => 'batch/delete'],
		],
		'ControllerEntrance' => [
			'index'  => ['action' => 'index',  'view' => 'entrance/index'],
			'save'   => ['action' => 'save',   'view' => 'entrance/save'],
			'edit'   => ['action' => 'edit',   'view' => 'entrance/edit'],
			'delete' => ['action' => 'delete', 'view' => 'entrance/delete'],
		],
		'ControllerProduct' => [
			'index'  => ['action' => 'index',  'view' => 'product/index'],
			'save'   => ['action' => 'save',   'view' => 'product/save'],
			'edit'   => ['action' => 'edit',   'view' => 'product/edit'],
			'delete' => ['action' => 'delete', 'view' => 'product/delete'],
		],
		'ControllerOutput' => [
			'index'  => ['action' => 'index',  'view' => 'output/index'],
			'save'   => ['action' => 'save',   'view' => 'output/save'],
			'edit'   => ['action' => 'edit',   'view' => 'output/edit'],
			'delete' => ['action' => 'delete', 'view' => 'output/delete'],
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
      
	// Analisa o que é necessário executar
	switch ($action) {

		case 'index':

			break;

		case 'save':     
			switch ($dto) {
				
				case 'InvoiceDTO':
					//$invoice = new InvoiceDTO($_REQUEST['numero'],$_REQUEST['path'],$_REQUEST['description']);
					$invoice = new InvoiceDTO(null, "descricao", "nome", "caminho");
					$controller->save($invoice);
					//include_once 'app/view/' . $view . '.php';
					var_dump($invoice);
					break;

				case 'BatchDTO':
					//$batch = new BatchDTO($_REQUEST['idnota'],$_REQUEST['codigo']);
					$batch = new BatchDTO(1,"555");	
					include_once 'app/view/' . $view . '.php';
					break;

				case 'EntranceDTO':
					//$entrance = new EntranceDTO($_REQUEST['idproduto'], $_REQUEST['idlote'], $_REQUEST['quantidade'],
					//$_REQUEST['validade'], $_REQUEST['valor'], $_REQUEST['identrada'], $_REQUEST['creationdate']);
					$entrance = new EntranceDTO(1,2,50);
					include_once 'app/view/' . $view . '.php';
					break;
				
				case 'ProductDTO':
					break;

				case 'OutputDTO':
					break;

				default:
					break;

			}
			break;



		case 'edit':
			switch ($dto) {

				case 'InvoiceDTO':
					//$invoice = new InvoiceDTO($_REQUEST['idnota'],$_REQUEST['path'],$_REQUEST['description']);
					$invoice = new InvoiceDTO(1, "atualizado");
					$controller->edit($invoice);
					//include_once 'app/view/' . $view . '.php';

					break;

				case 'BatchDTO':

					break;

				case 'EntranceDTO':
					
					break;
				case 'ProductDTO':
					break;

				case 'OutputDTO':
					break;

				default:
					break;
				
			}
				
		default:
		
			break;
	}


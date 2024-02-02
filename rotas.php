<?php
//require
require_once 'vendor/autoload.php';
//use
use App\Controller\ControllerConfig;

use App\Controller\ControllerInvoice;
use App\Controller\UploadNota;
use App\Model\DTO\BatchDTO;
use App\Model\DTO\CategoryDTO;
use App\Model\DTO\EntranceDTO;
use App\Model\DTO\InvoiceDTO;
use App\Model\DTO\LoanDTO;
use App\Model\DTO\ProductDTO;
use App\Model\DTO\requesterDTO;

//exit(var_dump($_REQUEST));
// Matriz para definições de rotas
$routes = [
	'ControllerInvoice' => [
		'index' => ['action' => 'index', 'view' => 'note/index'], 		// lista das notas fiscais
		'view' => ['action' => 'view', 'view' => 'note/view'], 		// visualização da nota
		'insert' => ['action' => 'insert', 'view' => 'note/insert'],		// tela para inserir uma nova nota
		'save' => ['action' => 'save', 'view' => 'note/save'],		// destino de formulário para inserir nova nota
		'update' => ['action' => 'update', 'view' => 'note/update'],		// tela de atualização de uma nota
		'edit' => ['action' => 'edit', 'view' => 'note/edit'],		// destino de formulário para atualizar a nota
		'delete' => ['action' => 'delete', 'view' => 'note/delete'],		// destino para deletar nota fiscal
	],
	'ControllerBatch' => [
		'index' => ['action' => 'index', 'view' => 'batch/index'],
		'insert' => ['action' => 'insert', 'view' => 'batch/insert'],
		'save' => ['action' => 'save', 'view' => 'batch/save'],
		'update' => ['action' => 'update', 'view' => 'batch/update'],
		'edit' => ['action' => 'edit', 'view' => 'batch/edit'],
		'delete' => ['action' => 'delete', 'view' => 'batch/delete'],
	],
	'ControllerEntrance' => [
		'index' => ['action' => 'index', 'view' => 'entrance/index'],
		'insert' => ['action' => 'insert', 'view' => 'entrance/insert'],
		'update' => ['action' => 'update', 'view' => 'entrance/update'],
		'save' => ['action' => 'save', 'view' => 'entrance/save'],
		'edit' => ['action' => 'edit', 'view' => 'entrance/edit'],
		'delete' => ['action' => 'delete', 'view' => 'entrance/delete'],
	],
	'ControllerProduct' => [
		'index' => ['action' => 'index', 'view' => 'product/index'],
		'insert' => ['action' => 'insert', 'view' => 'product/insert'],
		'update' => ['action' => 'update', 'view' => 'product/update'],
		'save' => ['action' => 'save', 'view' => 'product/save'],
		'edit' => ['action' => 'edit', 'view' => 'product/edit'],
		'delete' => ['action' => 'delete', 'view' => 'product/delete'],
	],
	'ControllerOutput' => [
		'index' => ['action' => 'index', 'view' => 'output/index'],
		'insert' => ['action' => 'insert', 'view' => 'output/insert'],
		'update' => ['action' => 'update', 'view' => 'output/update'],
		'save' => ['action' => 'save', 'view' => 'output/save'],
		'edit' => ['action' => 'edit', 'view' => 'output/edit'],
		'delete' => ['action' => 'delete', 'view' => 'output/delete'],
	],
	'Controllerhome' => [
		'index' => ['action' => 'index', 'view' => 'home/index'],
	],
];



extract($_REQUEST);

// Verifica se a rota condiz com os controllers
if (!isset($routes[$controller])) {
	header("Location: app/view/error404.php");							// Redireciona para a página de erro 404
	// Encerra o script após o redirecionamento

	// Verifica se a rota condiz com as ações
} else if (!isset($routes[$controller][$action])) {
	header("Location: app/view/error404.php");							// Redireciona para a página de erro 404
	exit(); 															// Encerra o script após o redirecionamento
}

$view = $routes[$controller][$action]['view'];							// Obtem rota relacionado aos _REQUEST  e armazena em array.

$controller = new ControllerConfig($controller);						// Instancia o controlador dinamicamente.

$dto = str_replace("Controller", "", $_REQUEST['controller']);    		// Remove inicio da string.
$dto .= 'DTO';															// Adiciona DTO no final do que sobrou da string	

// Analisa o que é necessário executar
switch ($action) {

	case 'index':
		switch ($dto) {
			case 'InvoiceDTO':
				//$controleNote = new ControllerInvoice();
				$notes = $controller->index();
			break;
		}
		include 'app/view/' . $view . '.php';
		break;
	case 'insert':
		include 'app/view/' . $view . '.php';
		break;
	case 'update':
		include 'app/view/' . $view . '.php';
		break;
	case 'view':
		include 'app/view/' . $view . '.php';
		break;
	//No caso de salvar, é necessário o DTO.	
	case 'save':
		switch ($dto) {
			case 'InvoiceDTO':
				//exit(var_dump($_REQUEST));
				$upload = new UploadNota(__DIR__ . '\repository');
				//
				$resultUpload = $upload->upload($_FILES['path']);
				//exit(var_dump($resultUpload));					

				/**
				 * Verficar se inseriu (senão é um exception)
				 * include_once 'app/view/' . $view . '.php?success=Nota inserida com sucesso.';
				 */
				if ($resultUpload !== false) {
					$invoice = new InvoiceDTO(intval($_REQUEST['numero']), $_REQUEST['description'], $resultUpload, gerarNomeAleatorio());
					try {
						$resultInsert = $controller->save($invoice);
						$_SESSION['app/view/note/insert']['sucess'] = "Nota inserida com sucesso.";
						include 'app/view/' . 'note/insert' . '.php';
					} catch (Exception $e) {
						$_SESSION['app/view/note/insert']['error'] = $e->getMessage();
						include 'app/view/' . 'note/insert' . '.php';
					}


				}

				break;

			case 'BatchDTO':
				//$batch = new BatchDTO($_REQUEST['idnota'],$_REQUEST['codigo']);
				$batch = new BatchDTO(1, "555");
				include_once 'app/view/' . $view . '.php';
				break;

			// case 'EntranceDTO':
			// 	//$entrance = new EntranceDTO($_REQUEST['idproduto'], $_REQUEST['idlote'], $_REQUEST['quantidade'],
			// 	//$_REQUEST['validade'], $_REQUEST['valor'], $_REQUEST['identrada'], $_REQUEST['creationdate']);
			// 	$entrance = new EntranceDTO(1,2,50);
			// 	include_once 'app/view/' . $view . '.php';
			// 	break;

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
				$invoice = new InvoiceDTO($_REQUEST['idnota'], $_REQUEST['path'], $_REQUEST['description']);
				//$invoice = new InvoiceDTO(1, "atualizado");
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
	
	case 'delete':
		switch ($_REQUEST['controller']) {
			case 'ControllerInvoice':				
				$result = $controller->delete($_REQUEST['id']);			
				exit(var_dump($result));
				break;
		}
		break;
}

function gerarNomeAleatorio()
{
	$dataAtual = date('Ymd');
	$numeroAleatorio = rand(1000, 9999);
	$identificadorUnico = uniqid();

	$nomeAleatorio = "{$dataAtual}_{$numeroAleatorio}_{$identificadorUnico}";

	return $nomeAleatorio;
}
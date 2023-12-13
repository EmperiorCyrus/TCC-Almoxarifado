<?php
  //======================================================================
  // CONTROLLER - CONFIGURADOR DE CONTROLLES
  //======================================================================
	namespace App\Controller;

	class ControllerConfig {

		private $controllerClass;		// Variavel para armazenar instancias



		/**
		 * Construct responsável por instanciar e manipular functions internas
		 * 
		 * @param string $controller		- Nome da class de algum controller 
		 */
		public function __construct(string $controller) {
			$this->controllerClass = $this->getControllerInstance($controller);		// Chama e armazena instancia no atributo da class
		}



		/**
		 * Função para selecionar métodos relacionada.
		 * 
		 * @param string $controller		- Nome da class de algum controller
		 * @return mixed								- Pode retornar diversas instancias e nulo em caso de não haver instancias relacionadas
		 */
		private function getControllerInstance(string $controller) {
			switch ($controller) {
				case 'ControllerInvoice':	return new ControllerInvoice();						// Em caso de houver controller relacionado, retorna instancia equivalente
				case 'ControllerBatch':		return new ControllerBatch();							// **
				case 'ControllerEntrance':  return new ControllerEntrance();					// **
				case 'ControllerOutput': 	return new ControllerOutput();						// **
				case 'ControllerProduct':	return new ControllerProduct();						// **

				// Em caso não encontrar Class relacionadas
				default:
					# Adicionar erro
					return null;
			}
		}



		/**
		 * Método mágico para capturar chamadas de métodos indefinidos e redirecioná-las para a instância do controlador.
		 * 
		 * @param string $method - O nome do método chamado dinamicamente.
		 * @param array  $args   - Um array contendo os argumentos passados para o método chamado.
		 * @return mixed         - O retorno do método chamado no controlador correspondente, ou null se o método não existir.
		 */
		public function __call($method, $args) {

			// Verifica o método selecionado se existe instância
			if (method_exists($this->controllerClass, $method)) {
				
				return call_user_func_array([$this->controllerClass, $method], $args);	// Retorna argumentos para as chamadas de instâncias

			// Caso não exista método
			} else {
				# Adicionar erro
				return null;
			}
		}
	}
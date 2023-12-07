<?php
	//======================================================================
	// DTO - SOLICITANTE
	//======================================================================
	namespace App\Controller\DTO;
	class requesterDTO {

		private $id;
		private $name;
		

		/**
		 * Construtor da classe responsável por inicializar um objeto com um ID e um nome.
		 *
		 * @param int    $id    ID a ser atribuído ao objeto
		 * @param string $name  Nome a ser atribuído ao objeto
		 */
		public function __construct($id, $name) {
			$this->id = $id;
			$this->name = $name;
		}

		// Métodos para definir dados
		public function set_id($id) 		{ $this->id = $id; }
		public function set_name($name) { $this->name = $name; }

		// Métodos para obter dados
		public function get_id() 		{ return $this->id; }
		public function get_name() 	{ return $this->name; }

	}

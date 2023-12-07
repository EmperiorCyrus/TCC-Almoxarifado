<?php
  //======================================================================
  // DTO - EMPRESTIMO
  //======================================================================
  namespace App\Model\DTO;

  class LoanDTO {

      private $idloan;        // ID do empréstimo
      private $identrada;     // ID da entrada


      /**
       * Construtor da classe responsável por inicializar um objeto de empréstimo.
       *
       * @param int $idloan
       * @param int $identrada
       */
      public function __construct($idloan, $identrada) {
          $this->idloan    = $idloan;       // Encapsulando dados recebidos
          $this->identrada = $identrada;    // **
      }

      // Métodos para definir dados
      public function setIdLoan($idloan):       void { $this->idloan = $idloan; }
      public function setIdEntrada($identrada): void { $this->identrada = $identrada; }

      // Métodos para obter dados
      public function getIdLoan()    { return $this->idloan; }
      public function getIdEntrada() { return $this->identrada; }
  }
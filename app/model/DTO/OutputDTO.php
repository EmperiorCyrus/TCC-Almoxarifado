<?php
  //======================================================================
  // DTO - NOTA
  //======================================================================
  namespace App\Model\DTO;

  /**
   * Classe para armazenar dados de uma nota.
   * Seguindo padrões Data Transfer Object (DTO),
   * essa classe será o intermediário entre o Model e o Controller.
   *
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class OutputDTO {

      private $idregister;
      private $quantity;
      private $output_date;
      private $idproduto;
      private $idemprestimo;
      private $idsolicitacao;

      /**
       * Construct responsável por encapsular dados da nota.
       *
       * @param             int          $idproduto
       * @param             int          $quantity
       * @param             int          $idregister
       * @param string|null $output_date
       * @param             int          $idemprestimo
       * @param             int          $idsolicitacao
       */
      public function __construct(int $idproduto = null, int $quantity = null, int $idregister = null, string $output_date = null, int $idemprestimo = null, int $idsolicitacao = null) {
          $this->idproduto     = $idproduto    ;
          $this->quantity      = $quantity     ;
          $this->idregister    = $idregister   ;
          $this->output_date   = $output_date  ;
          $this->idemprestimo  = $idemprestimo ;
          $this->idsolicitacao = $idsolicitacao;
      }

      // Funções para adicionar dados da saida
      public function setQuantity     (        int          $quantity    ): void { $this->quantity     = $quantity     ; }
      public function setCreationDate (        ?string      $output_date ): void { $this->output_date  = $output_date  ; }
      public function setIdproduto    (        int          $idproduto   ): void { $this->idproduto    = $idproduto    ; }
      public function setIdemprestimo (        int          $idemprestimo): void { $this->idemprestimo = $idemprestimo ; }
      public function setSolicitacao  (        int          $solicitacao ): void { $this->solicitacao  = $solicitacao  ; }

      // Funções para obter dados da nota
      public function getIdregister   (): ?int    { return $this->idregister   ; }
      public function getQuantity     (): int     { return $this->quantity     ; }
      public function getCreationDate (): ?string { return $this->output_date  ; }
      public function getIdproduto    (): ?int    { return $this->idproduto    ; }
      public function getIdemprestimo (): ?int    { return $this->idemprestimo ; }
      public function getSolicitacao  (): ?int    { return $this->solicitacao  ; }
  }


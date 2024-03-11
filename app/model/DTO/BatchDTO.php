<?php
  //======================================================================
  // DTO - LOTE
  //======================================================================
  namespace App\Model\DTO;

  /**
   * Classe para armazenar dados de um lote.
   * Seguindo padrões Data Transfer Object (DTO),
   * essa classe será o intermediário entre o Model e o Controller.
   *
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class BatchDTO {

      private $idbatch;
      private $cod;
      private $creation_date;
      private $idinvoice;

      /**
       * Construct responsável por encapsular dados do lote.
       *
       * @param int|null    $idinvoice
       * @param string|null $cod
       * @param mixed    $idbatch
       * @param string|null $creation_date
       */
      public function __construct(int $idinvoice = null, string $cod = null, int $idbatch = null, string $creation_date = null) {
          $this->idinvoice     = $idinvoice;
          $this->cod           = $cod;
          $this->idbatch       = $idbatch;
          $this->creation_date = $creation_date;
      }

      // Funções para adicionar dados do lote
      public function setCod(?string $cod):                    void { $this->cod = $cod; }
      public function setCreationDate(?string $creation_date): void { $this->creation_date = $creation_date; }
      public function setIdInvoice(int $idinvoice):            void { $this->idinvoice = $idinvoice; }

      // Funções para obter dados do lote
      public function getIdBatch():      ?int    { return $this->idbatch; }
      public function getCod():          ?string { return $this->cod; }
      public function getCreationDate(): ?string { return $this->creation_date; }
      public function getIdInvoice():    ?int    { return $this->idinvoice; }
  }


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

      private int    $idbatch;
      private string $cod;
      private string $creation_date;
      private int    $idinvoice;

      /**
       * Construct responsável por encapsular dados do lote.
       *
       * @param string|null $cod
       * @param string|null $creation_date
       * @param int|null    $idinvoice
       */
      public function __construct(int $idinvoice = null, ?string $cod = null, ?int $idbatch = null, ?string $creation_date = null) {
          $this->cod           = $cod;
          $this->idbatch       = $idbatch;
          $this->creation_date = $creation_date;
          $this->idinvoice     = $idinvoice;
      }

      // Funções para adicionar dados do lote
      public function setCod(?string $cod):                    void { $this->cod = $cod; }
      public function setCreationDate(?string $creation_date): void { $this->creation_date = $creation_date; }
      public function setIdInvoice(int $idinvoice):           void { $this->idinvoice = $idinvoice; }

      // Funções para obter dados do lote
      public function getIdBatch():      ?int    { return $this->idbatch; }
      public function getCod():          ?string { return $this->cod; }
      public function getCreationDate(): ?string { return $this->creation_date; }
      public function getIdInvoice():    ?int    { return $this->idinvoice; }
  }


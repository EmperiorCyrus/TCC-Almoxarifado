<?php
  //======================================================================
  // DTO - ENTRADA
  //======================================================================
  namespace App\Model\DTO;

  /**
   * Classe para armazenar dados de entrada.
   * Seguindo padrões Data Transfer Object (DTO),
   * essa classe será o intermediário entre o Model e o Controller.
   *
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class EntranceDTO {

    private $identrance;    // ID da entrada
    private $value;         // Validade do produto
    private $amount;        // Quantidade da entrada
    private $validity;      // Validade do produto
    private $creation_date; // Data de criação
    private $idproduct;     // ID do produto (chave estrangeira)
    private $idbatch;       // ID do lote (chave estrangeira)


    /**
     * Construtor responsável por inicializar um objeto EntranceDTO com os dados da entrada.
     *
     * @param int     $idproduct
     * @param int     $idbatch
     * @param mixed   $amount
     * @param string  $validity       - Sem obrigatoriedade
     * @param mixed   $value          - Sem obrigatoriedade
     * @param int     $identrance     - Sem obrigatoriedade
     * @param string  $creation_date  - Sem obrigatoriedade
     */
    public function __construct($idproduct, $idbatch, $amount, $validity = null, $value = null, $identrance = null, $creation_date = null) {
      $this->identrance = $identrance;        // Encapsulando dados recebidos
      $this->amount = $amount;                // **
      $this->validity = $validity;            // **
      $this->value = $value;                  // **
      $this->idproduct = $idproduct;          // **
      $this->idbatch = $idbatch;              // **
      $this->creation_date = $creation_date;  // **

    }

    // Métodos para definir dados
    public function setIdEntrance($identrance):       void { $this->identrance = $identrance; }
    public function setAmount($amount):               void { $this->amount = $amount; }
    public function setValidity($validity):           void { $this->validity = $validity; }
    public function setValue($value):                 void { $this->value = $value; }
    public function setIdProduct($idproduct):         void { $this->idproduct = $idproduct; }
    public function setIdBatch($idbatch):             void { $this->idbatch = $idbatch; }
    public function setCreationDate($creation_date):  void { $this->creation_date = $creation_date; }


    // Métodos para obter dados
    public function getIdEntrance()   { return $this->identrance; }
    public function getAmount()       { return $this->amount; }
    public function getValidity()     { return $this->validity; }
    public function getValue()        { return $this->value; }
    public function getIdProduct()    { return $this->idproduct; }
    public function getIdBatch()      { return $this->idbatch; }
    public function getCreationDate() {return $this->creation_date; }
  }




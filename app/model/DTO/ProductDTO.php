<?php
  //======================================================================
  // DTO - PRODUCT
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
  class ProductDTO {

    private $idproduct;      // ID do produto
    private $name;           // Nome do produto #
    private $brand;          // Marca do produto #
    private $min;            // Valor minimo para restoque.
    private $measurement     // Unidade de medida.
    private $perishable;     // Perecível #
    private $disposable;     // Descartável #
    private $creation_date;  // Data de criação
    private $idstorage;      // ID do armazenamento
    private $idsupplier;     // ID do fornecedor
    private $idcategory;     // ID da categoria
    private $auto_product;   // ID de auto-relacionamento de Produto



    /**
     * Construtor responsável por inicializar um objeto ProductDTO com os dados do produto.
     *
     * @param string  $name
     * @param string  $brand
     * @param bool    $perishable
     * @param bool    $disposable
     * @param int     $min             
     * @param string  $measurement
     * @param int     $idproduct       - Sem obrigatoriedade
     * @param string  $creation_date   - Sem obrigatoriedade
     * @param int     $idstorage       - Sem obrigatoriedade
     * @param int     $idsupplier      - Sem obrigatoriedade
     * @param int     $idcategory      - Sem obrigatoriedade
     * @param int     $auto_product    - Sem obrigatoriedade
     */
    public function __construct($name, $brand, $perishable, $disposable, $min, $measurement, $idproduct = null, $creation_date = null, $idstorage = null, $idsupplier = null, $idcategory = null, $auto_product = null) {
      $this->idproduct = $idproduct;            // Encapsulando dados recebidos
      $this->name          = $name;             // **
      $this->brand         = $brand;            // **
      $this->min           = $min;              // **
      $this->measurement   = $measurement;      // **
      $this->perishable    = $perishable;       // **
      $this->disposable    = $disposable;       // **
      $this->creation_date = $creation_date;    // **
      $this->idstorage     = $idstorage;        // **
      $this->idsupplier    = $idsupplier;       // **
      $this->idcategory    = $idcategory;       // **
      $this->auto_product  = $auto_product;     // **
    }


    // Métodos para definir dados
    public function setIdProduct($idproduct):        void { $this->idproduct = $idproduct; }
    public function setName($name):                  void { $this->name = $name; }
    public function setBrand($brand):                void { $this->brand = $brand; }
    public function setMin($min):                    void { $this->min = $min; }
    public function setMeasurement($measurement):    void { $this->measurement = $measurement }
    public function setPerishable($perishable):      void { $this->perishable = $perishable; }
    public function setDisposable($disposable):      void { $this->disposable = $disposable; }
    public function setCreationDate($creation_date): void { $this->creation_date = $creation_date; }
    public function setIdStorage($idstorage):        void { $this->idstorage = $idstorage; }
    public function setIdSupplier($idsupplier):      void { $this->idsupplier = $idsupplier; }
    public function setIdCategory($idcategory):      void { $this->idcategory = $idcategory; }
    public function setAutoProduct($auto_product):   void { $this->auto_product = $auto_product; }


    // Métodos para obter dados
    public function getIdProduct():    ?int    { return $this->idproduct; }
    public function getName():         ?string { return $this->name; }
    public function getBrand():        ?string { return $this->brand; }
    public function getMin():          int     { return $this->min; }
    public function getMeasurement():  string  { return $this->measurement; }
    public function getPerishable():   bool    { return $this->perishable; }
    public function getDisposable():   bool    { return $this->disposable; }
    public function getCreationDate(): string  { return $this->creation_date; }
    public function getIdStorage():    ?int    { return $this->idstorage; }
    public function getIdSupplier():   ?int    { return $this->idsupplier; }
    public function getIdCategory():   ?int    { return $this->idcategory; }
    public function getAutoProduct():  ?int    { return $this->auto_product; }
  }
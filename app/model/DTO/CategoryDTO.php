<?php
  //======================================================================
  // DTO - CATEGORIA
  //======================================================================
  namespace App\Model\DTO;

  /**
   * Classe para armazenar dados da categoria do produto.
   * Seguindo padrões Data Transfer Object (DTO),
   * essa classe será o intermedio entre o Model e o Controller.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @version 1.0
   */
  class CategoryDTO {

    private int $idcategory;
    private string $name;


    /**
     * Construct responsável por encapsular dados da nota-fiscal.
     * 
     * @param string  $name
     */
    public function __construct($name = null, $idcategory = null) {
      $this->idcategory = $idcategory;  // Encapsulando dados recebidos
      $this->name = $name;              // **
    }

    // Funções para adicionar dados de categoria
    public function setName($name):             void { $this->name = $name; }
    public function setIdcategory($idcategory): void { $this->idcategory = $idcategory; }
    
    
    // Funções para obter dados da categoria
    public function getIdcategory(): int    { return $this->idcategory; }
    public function getName():       string { return $this->name; }
    
    
      
    













  }
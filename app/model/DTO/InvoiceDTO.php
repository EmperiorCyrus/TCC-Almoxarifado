<?php
  //======================================================================
  // DTO - NOTA
  //======================================================================
  namespace App\Model\DTO;

  /**
   * Classe para armazenar dados da nota-fiscal.
   * Seguindo padrões Data Transfer Object (DTO),
   * essa classe será o intermedio entre o Model e o Controller.
   * 
   * @author Wesley Portugal Santana - wesporsan01@gmail.com
   * @author Gustavo Calvacante -
   * 
   * @version 1.0
   */
  class InvoiceDTO
  {
    private $idinvoice;                           // ID padrão da nota-fiscal (NF).
    private $name;                                // Nome da NF, usando padrão.
    private $path;                                // Caminho da NF no sistema.
    private $description;                         // Observação da NF dado pelo usuário.
    private $creation_date;                       // Data da NF ao ser direcionado ao sistema


    /**
     * Construct responsável por encapsular dados da nota-fiscal.
     * 
     * @param int     $idinvoice      - Sem obrigatoriedade
     * @param string  $description    - Sem obrigatoriedade
     * @param string  $name           - Sem obrigatoriedade
     * @param string  $path           - Sem obrigatoriedade
     * @param string  $creation_date  - Sem obrigatoriedade
     */
    public function __construct(string $description, string $path, string $name = null, string $creation_date = null,int $idinvoice = null) {
      $this->idinvoice     = $idinvoice;          // Encapsulando dados recebidos
      $this->path          = $path;               // **
      $this->name          = $name;               // **
      $this->description   = $description;        // **
      $this->creation_date = $creation_date;      // **
    }

    
    // Funções para definir dados
    public function setIdinvoice(int $idinvoice):            void { $this->idinvoice = $idinvoice; }
    public function setName(string $name):                   void { $this->name = $name; }
    public function setPath(string $path):                   void { $this->path = $path; }
    public function setDescription(string $description):     void { $this->description = $description; }
    public function setCreation_date(string $creation_date): void { $this->creation_date = $creation_date; }
    
    
    // Funções para obter dados
    public function getIdinvoice():    ?   int { return intval($this->idinvoice); }
    public function getPath():         ?string { return $this->path; }
    public function getDescription():  ?string { return $this->description; }
    public function getName():         ?string { return $this->name; }
    public function getCreation_date():?string { return $this->creation_date; }


}
    

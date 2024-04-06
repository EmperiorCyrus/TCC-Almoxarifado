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
  class NoteDTO {

      private $idnote;
      private $path;
      private $creation_date;
      private $description;
      private $name;

      /**
       * Construct responsável por encapsular dados da nota.
       *
       * @param string        $description
       * @param string|null   $path
       * @param int           $idnote
       * @param string|null   $creation_date
       * @param string        $name
       */
      public function __construct(string $description = null, string $path = null, int $idnote = null, string $creation_date = null, string $name = null) {
          $this->description     = $description;
          $this->path            = $path;
          $this->idnote          = $idnote;
          $this->creation_date   = $creation_date;
          $this->name            = $name;
      }

      // Funções para adicionar dados da nota
      public function setPath(?string $path):                    void { $this->path = $path; }
      public function setCreationDate(?string $creation_date):   void { $this->creation_date = $creation_date; }
      public function setDescription(int $description):          void { $this->description = $description; }
      public function setName(string $name):                     void { $this->name = $name; }

      // Funções para obter dados da nota
      public function getIdNote():         ?int        { return $this->idnote; }
      public function getPath():           ?string     { return $this->path; }
      public function getCreationDate():   ?string     { return $this->creation_date; }
      public function getDescription():    ?int        { return $this->description; }
      public function getName():           ?string     { return $this->name; }
  }


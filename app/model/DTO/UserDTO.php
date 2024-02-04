<?php
//======================================================================
// DTO - USER
//======================================================================
namespace App\Model\DTO;

/**
 * Classe para armazenar dados de um usuário.
 * Seguindo padrões Data Transfer Object (DTO),
 * essa classe será o intermediário entre o Model e o Controller.
 *
 * @author Greg :D - antonioimportant@gmail.com
 * @version 1.0
 */
class UserDTO
{
    private $iduser;
    private $name;
    private $email;
    private $password;
    private $idusertype;

    /**
     * Construct responsável por encapsular dados do usuário.
     *
     * @param int|null    $idusertype
     * @param string|null $name
     * @param int|null    $iduser
     * @param string|null $password
     * @param string|null $email
     */
    public function __construct(int $idusertype = null, string $name = null, int $iduser = null, string $email = null, string $password = null)
    {
        $this->idusertype = $idusertype;
        $this->name = $name;
        $this->iduser = $iduser;
        $this->email = $email;
        $this->password = $password;
    }

    // Funções para adicionar dados do usuário
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function setIdUserType(int $idusertype): void
    {
        $this->idusertype = $idusertype;
    }


    // Funções para obter dados do usuário
    public function getIdUser(): ?int
    {
        return $this->iduser;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getIdusertype()
    {
        return $this->idusertype;
    }
}

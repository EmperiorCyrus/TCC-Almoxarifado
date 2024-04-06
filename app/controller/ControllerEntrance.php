<?php
namespace App\Controller;

use App\Model\DTO\EntranceDTO;
use App\Model\ModelEntrance;

class ControllerEntrance
{
    private ModelEntrance $entranceModel;

    public function __construct()
    {
        $this->entranceModel = new ModelEntrance();  // Está dando um errozinho de driver na hora de mostrar a tela
    }

    /**
   * Método que retorna a view de listagem de entradas
   *
   * @return void
   */
    public function index()
    {
        $entradas = $this->entranceModel->selectAll();

        return view("app/view/entrance/index.php", ["entradas" => $entradas]);
    }

    /**
     * Método responsável por criar uma nova entrada
     *
     * @return void
     */
    public function create()
    {
        return view("app/view/entrance/insert.php");
    }

    public function insert(EntranceDTO $entrance): bool
    {
        return $this->entranceModel->insert($entrance);
    }

    public function update(EntranceDTO $entrance): bool
    {
        return $this->entranceModel->update($entrance);
    }

    public function delete(int $id): bool
    {
        return $this->entranceModel->delete($id);
    }

    public function selectAll(): array
    {
        return $this->entranceModel->selectAll();
    }

    public function selectById(int $id): EntranceDTO
    {
        return $this->entranceModel->selectById($id);
    }
}
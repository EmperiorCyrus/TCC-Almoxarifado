<?php
namespace App\Controller;

use App\Model\DTO\EntranceDTO;
use App\Model\ModelEntrance;

class ControllerEntrance
{
    private ModelEntrance $entranceModel;

    public function __construct()
    {
        $this->entranceModel = new ModelEntrance();
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
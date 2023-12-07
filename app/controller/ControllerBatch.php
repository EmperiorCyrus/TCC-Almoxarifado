<?php
  namespace App\Controller;

  use App\Model\DTO\BatchDTO;
  use App\Model\ModelBatch;

  class ControllerBatch
  {
    private ModelBatch $batchModel;

    public function __construct()
    {
        $this->batchModel = new ModelBatch();
    }


    public function selectAll(): array
    {
        return $this->batchModel->selectAll();
    }

    public function selectById(int $id): ?BatchDTO
    {
        return $this->batchModel->selectById($id);
    }

    public function insert(BatchDTO $batch): bool
    {
        return $this->batchModel->insert($batch);
    }

    public function update(BatchDTO $batch): bool
    {
        return $this->batchModel->update($batch);
    }

    public function delete(int $id): bool
    {
        return $this->batchModel->delete($id);
    }
}
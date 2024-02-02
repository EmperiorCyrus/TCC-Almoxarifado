<?php
  //======================================================================
  // CONTROLLER - PRODUTO
  //======================================================================
    namespace App\Controller;

    use App\Model\DTO\ProductDTO;
    use App\Model\ModelProduct;


    class ControllerProduct
    {

        private ModelProduct $ProductModel;

        public function __construct()
        {
            $this->ProductModel = new ModelProduct();
        }

        
        public function save(ProductDTO $note)
        {   
            return $this->ProductModel->insert($note);
        }

        public function edit(ProductDTO $note): bool
        {
            return $this->ProductModel->update($note);
        }

        public function delete(int $id): bool
        {
            return $this->ProductModel->delete($id);
        }

        public function index(): array
        {
            return $this->ProductModel->selectAll();
        }

        public function selectById(int $id): ProductDTO
        {
            return $this->ProductModel->selectById($id);
        }
    }
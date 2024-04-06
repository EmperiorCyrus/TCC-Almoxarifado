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
        $this->ProductModel = new ModelProduct(); // Está dando um errozinho de driver na hora de mostrar a tela
    }

    /**
     * Método responsável por criar uma nova entrada
     *
     * @return void
     */
    public function create()
    {
        return view("app/view/product/insert.php");
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

    /**
     * Método que retorna a view de listagem de produtos
     *
     * @return void
     */
    public function index()
    {
        $produtos = $this->ProductModel->get_all_info_product();
        return view("app/view/product/index.php", ["produtos" => $produtos]);
    }

    public function selectById(int $id): ProductDTO
    {
        return $this->ProductModel->selectById($id);
    }
}
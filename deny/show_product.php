<?php
namespace App\Controller;
//require_once("../model/model_product.php");
require_once("../app/model/model_product.php");


//  ADICIONAR metodo para verificar se é um usuario autentico do sistema para poder exibir os dados.
class show_product {
  
  public function show_all_product() {
        // verificar usuario


        $product = new product();
        $products = $product->get_all_info_product();


        while (!empty($products['id'])) {
          for ($i = 0; $i < count($products['id']); $i++) {
?>
          <tr>
            <th><?=$products['id'][$i]?></th>
            <th><?=$products['name'][$i]?></th>
            <th><?=$products['brand'][$i]?></th>
            <?php
              if ($products['supplier'][$i] == "" || $products['supplier'][$i] == null) {
                echo ("<th><button>Vincular</button></th>");} 
              else {
                echo ("<th>'$products'['supplier'][$i]</th>");
              }
            ?>
            <th><?=$products['category'][$i]?></th>
            <th><?=$products['storage'][$i]?></th>
            
          </tr>


<?php  
          }
          break;
        }

    }  


  
}



//$item = new show_product();
//$item->show_all_product();



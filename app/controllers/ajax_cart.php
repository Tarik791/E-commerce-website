<?php 

class Ajax_cart extends Controller {


   //šaljemo podatke iz ajax kontrolera
   public function index(){


   }
   public function delete_item($data = ""){


    //mijenjamo podatke u json
    $obj = json_decode($data);

    $id = esc($obj->id);
    
    $id = esc($id);

    //povecavamo kolicinu uz pomoć petlji
    if(isset($_SESSION['CART'])){

        //Uz pomoć kljuca dodajemo istu stvar u item
        foreach ($_SESSION['CART'] as $key => $item) {
            # code...
            
            //da li je stavka ispravna
            if($item['id'] == $id){

                //brisanje stavke
                unset($_SESSION['CART'][$key]);
                
                //čistimo niz
                $_SESSION['CART'] = array_values($_SESSION['CART']);
                break;
            }

        }
    }
    
    $obj->data_type = "delete_item";
    echo json_encode($obj);


   }


   public function edit_quantity($data = ""){

    //mijenjamo podatke u json
    $obj = json_decode($data);

    $quantity = esc($obj->quantity);
    $id = esc($obj->id);

    //povecavamo kolicinu uz pomoć petlji
    if(isset($_SESSION['CART'])){

        //Uz pomoć kljuca dodajemo istu stvar u item
        foreach ($_SESSION['CART'] as $key => $item) {
            # code...
            
            if($item['id'] == $id){

                $_SESSION['CART'][$key]['qty'] = (int)$quantity;
                break;
            }

        }
    }


        $obj->data_type = "edit_quantity";
        echo json_encode($obj);

    }
}


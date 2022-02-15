<?php 
//kada napravimo novi page napravimo kontroller za taj page i sljedece sto slijedi jeste kopiramo sve iz home page i paste na taj page

class Cart extends Controller {



public function index(){

$User = $this->load_model('User');
$image_class = $this->load_model('Image');
$user_data = $User->check_login();

if(is_object($user_data)){

$data['user_data'] = $user_data;


}

$DB = Database::newInstance();
$ROWS = false;
$prod_ids = array();
if(isset($_SESSION['CART'])){

    //citamo id-eve sve iz baze podataka
    $prod_ids = array_column($_SESSION['CART'], 'id');
    //implode pretvara niz u niz 
    $ids_str = "'" . implode("','", $prod_ids) . "'";

    $ROWS = $DB->read("select * from products where id in ($ids_str)");

}


//ako je ovo array idemo kroz foreach
if(is_array($ROWS)){

    foreach ($ROWS as $key => $row) {
      
        
        foreach ($_SESSION['CART'] as $item) {
            
            # ako je row id jednak  zelimo jos jedan id skojim to mozemo uporediti
            if($row->id == $item['id']){
                $ROWS[$key]->cart_qty = $item['qty'];
                break;
            }
        }
       
    }

}

$data['page_title'] = "Cart";
//kreiranje ukupnog zbira
$data['sub_total'] = 0;

if($ROWS){
    foreach ($ROWS as $key => $row) {

        //velicina fotografije proizvoda
        $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
        //izracunavanje total price
        $mytotal = $row->price * $row->cart_qty;


        $data['sub_total'] += $mytotal;
    }

}

if(is_array($ROWS)){

rsort($ROWS);
}
$data['ROWS'] = $ROWS;

$this->view("cart", $data);

}

}

?>
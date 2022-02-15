<?php 
//kada napravimo novi kontrolor za odredjen page onda ispravke napravimo koje su neophodne za taj page
class Product_details extends Controller {



   public function index($slag){

    //ovaj slag koristimo da citamo podatke iz baze podataka
    $slag = esc($slag);

    $User = $this->load_model('User');
    $user_data = $User->check_login();

    if(is_object($user_data)){

    $data['user_data'] = $user_data;


    }


    $DB = Database::newInstance();

    $ROW = $DB->read("select * from products where slag = :slag", ['slag'=>$slag]);

    $data['page_title'] = "Product Details";

    $data['ROW'] = is_array($ROW) ? $ROW[0] : false;

    $this->view("product-details", $data);


    }



}




?>
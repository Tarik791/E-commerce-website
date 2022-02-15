<?php 

class Ajax_checkout extends Controller {


   //šaljemo podatke iz ajax kontrolera
   public function index($data_type = '', $id = ''){

    //uzimanje podataka
    $info = file_get_contents("php://input");
    //info sadrži naše json podatke
    $info = json_decode($info);

    $id = $info->data->id;

    $countries = $this->load_model('Countries');
    $data = $countries->get_states($id);

    echo json_encode($data);
    //niz stvara niz i pretvaramo ga u objekt
    $info = (object)[];
    $info->data = $data;
    $info->data_type = "get_states";

    echo json_encode($info);

    }

}
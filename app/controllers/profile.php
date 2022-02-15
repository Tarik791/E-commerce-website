<?php 

class Profile extends Controller {



   public function index($url_address = null){

    //ućitavanje klasa
    $User = $this->load_model('User');
    $Order = $this->load_model('Order');

    //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
    $user_data = $User->check_login(true);

    if($url_address){

        //prikaz korisničkog profila(korisnik može vidjeti svoj profil, obrisati ovo) ->
        $_SESSION['user_url'] = isset($_SESSION['user_url']) ? $_SESSION['user_url'] : '';
        $url_address = $url_address == 'home' ? $_SESSION['user_url'] : $url_address;
        //obrisati <-

        $profile_data = $User->get_user($url_address);
    }else{
        $profile_data = $user_data;
    }

    if(is_object($user_data)){
        $data['user_data'] = $user_data;
    }


    //ako je ovo array , funkciju ćemo pročitati
    if(is_object($profile_data)){
        

    //dobijamo narudzbe od ovog korisnika
    $orders = $Order->get_orders_by_user($profile_data->url_address);

    //ako nije, orders je false
    }else{

        $orders = false;
    }

    if(is_array($orders)){
        //dodajemo sve kupljene stvari
        foreach ($orders as $key => $row) {
            
            $details = $Order->get_order_details($row->id);

            $grand_total = 0;

            if($details){
            //vraćamo total iz jedne kolone niza
            $totals = array_column($details, "total");

            //vraćamo zbir svih vrijednosti u nizu 
            $grand_total = array_sum($totals);

            }


            $orders[$key]->details = $details;
            $orders[$key]->grand_total = $grand_total;
        }


    }

    //podaci o licnom profilu
    $data['profile_data'] = $profile_data;
    $data['page_title'] = "Profile";
    //i isporucujemo narudzbe
    $data['orders'] = $orders;

    $this->view("profile", $data);


    }



}




?>
<?php 

Class Order extends Controller{

    public $errors = array();

    //validacija podataka
    public function validate($POST){

        $this->errors = array();
        foreach ($POST as $key => $value) {
            # code...
    
            if($key == "country"){
    
                //ako je vrijednost jednaka praznoj u redu je ili
                if($value == "" || $value == "-- Country --"){
    
                    $this->errors[] = "Please enter a valid country";
    
                }
            }
    
    
    
            /*if($key == "state"){
    
                //ako je vrijednost jednaka praznoj u redu je ili
                if($value == "" || $value == "-- State / Province / Region --"){
    
                    $this->errors[] = "Please enter a valid state";
    
                }
            }*/

        if($key == "address1"){
    
                //ako je vrijednost jednaka praznoj u redu je ili
                if(empty($value)){
    
                    $this->errors[] = "Please enter a valid address 1";
    
                }
            }
        if($key == "postal_code"){
    
                //ako je vrijednost jednaka praznoj u redu je ili
                if(empty($value)){
    
                    $this->errors[] = "Please enter a valid postal code";
    
                }
            }

            if($key == "mobile_phone"){
    
                //ako je vrijednost jednaka praznoj u redu je ili
                if(empty($value)){
    
                    $this->errors[] = "Please enter a valid mobile number";
    
                }
            }



    
    
        }        

    }
    
    //Sačuvamo u bazu podataka
    public function save_order($POST,$ROWS, $user_url, $sessionid){

    $db = Database::newInstance();

        if(is_array($ROWS) && count($this->errors) == 0){
        
        //inicijalizacija countries klase
        $countries = $this->load_model('Countries');

        $data = array();
        $data['user_url'] = $user_url;
        $data['sessionid'] = $sessionid;
        $data['datetimetwo'] = $POST['datetimetwo'];
        //$data['delivery_address'] = $POST['address1'] . " " . $POST['address2'];
        $data['total'] = $POST['total'];
        $data['description'] = $POST['description'];
		//$country_obj = $countries->get_country($POST['country']);
        //$data['country'] = $country_obj->country;
        //$data['country'] = $POST['country'];
		//$state_obj = $countries->get_state($POST['state']);
        //$data['state'] = $POST['state'];
        $data['zip'] = $POST['postal_code'];
        $data['tax'] = 0;
        $data['shipping'] = 0;
        $data['date'] = date("Y-m-d H:i:s");
        $data['datetime'] = $POST['datetime'];
        $data['mobile_phone'] = $POST['mobile_phone'];

        //save details
        $orderid = 0;
        $query = "select id from orders order by id desc limit 1";
        $result = $db->read($query);

        //provjera
        if(is_array($result)){

            $orderid = $result[0]->id + 1;

            
        }


        $query = "insert into orders (description, user_url,datetimetwo,total, zip, tax, shipping, date, sessionid,mobile_phone,datetime) values (:description, :user_url,:datetimetwo,:total, :zip,:tax,:shipping,:date,:sessionid,:mobile_phone,:datetime)";

        //pišemo u bazu podataka
        $result = $db->write($query,$data);


            foreach ($ROWS as $row) {
                # code...
                
            $data = array();
            $data['orderid'] = $orderid;
            $data['qty'] = $row->cart_qty;
            $data['description'] = $row->description;
            $data['amount'] = $row->price;
            $data['total'] = $row->cart_qty * $row->price;
            $data['productid'] = $row->id;

            $query = "insert into order_details (orderid, qty, description, amount, total, productid) values (:orderid, :qty, :description, :amount, :total, :productid)";
            //pišemo u bazu podataka
            $result = $db->write($query,$data);
            }


        }
    
    }

    //primamo narudzbe od korisnika
    public function get_orders_by_user($user_url){

        $orders = false;

        $db = Database::newInstance();
        $data['user_url'] = $user_url;

        $query = "select * from orders where user_url = :user_url order by id desc limit 100";
        //pišemo u bazu podataka
        $orders = $db->read($query,$data);

       
        return $orders;
    }


    //brojač narudžbi
    public function get_orders_count($user_url){


        $db = Database::newInstance();
        $data['user_url'] = $user_url;

        $query = "select id from orders where user_url = :user_url";
        //pišemo u bazu podataka
        $result = $db->read($query,$data);

        $orders = is_array($result) ? count($result) : 0;
        return $orders;
    }


        //primamo svih narudzbi od korisnika
        public function get_all_orders(){

            $orders = false;
    
            $db = Database::newInstance();

            $limit = 10;
            $offset = Page::get_offset($limit);

            $query = "select * from orders order by id desc limit $limit offset $offset";
            //pišemo u bazu podataka
            $orders = $db->read($query);
    
           
            return $orders;
        }

        //primamo detalje narudzbe
        public function get_order_details($id){

            $details = false;
            $data['id'] = addslashes($id);
            $db = Database::newInstance();
    
            $query = "select * from order_details where orderid = :id order by id desc";
            //pišemo u bazu podataka
            $details = $db->read($query,$data);
    
            
            return $details;
        }
        

}

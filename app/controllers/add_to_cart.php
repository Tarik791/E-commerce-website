<?php 
//kada napravimo novi page napravimo kontroller za taj page i sljedece sto slijedi jeste kopiramo sve iz home page i paste na taj page

//The page isn’t redirecting properly -> ovo se dešava ako se stranica ponavlja iznova i iznova u redirect-u

class Add_to_cart extends Controller {

   private $redirect_to = "";

   public function index($id = ''){

    $id = esc($id);
    $DB = Database::newInstance();

  
    $ROWS = $DB->read("select * from products where id = :id limit 1",["id"=>$id]);


    if($ROWS){
        $ROW = $ROWS[0];

        //ako kartica postoji
        if(isset($_SESSION['CART'])){

            $ids = array_column($_SESSION['CART'], "id");
            if(in_array($ROW->id, $ids)){
                $key = array_search($ROW->id, $ids);
                $_SESSION['CART'][$key]['qty']++;
            }else{
                //stvorili smo niz
                $arr = array();
                $arr['id'] = $ROW->id;
                $arr['qty'] = 1;

                //niz dodajemo ovdje
                $_SESSION['CART'][] = $arr;
            }

        }else{

            //stvorili smo niz
            $arr = array();
            $arr['id'] = $ROW->id;
            $arr['qty'] = 1;

            //niz dodajemo ovdje
            $_SESSION['CART'][] = $arr;

        }

    }

    header("Location: " . ROOT . "cart");

    }

    //dodavanje kolicine 
    public function add_quantity($id = ''){

        $this->set_redirect();

        $id = esc($id);

        //povecavamo kolicinu uz pomoć petlji
        if(isset($_SESSION['CART'])){

            //Uz pomoć kljuca dodajemo istu stvar u item
            foreach ($_SESSION['CART'] as $key => $item) {
                # code...
                
                if($item['id'] == $id){

                    $_SESSION['CART'][$key]['qty'] += 1;
                    break;
                }

            }
        }


        $this->redirect();

        
    }


    //oduzimanje kolicine
    public function subtract_quantity($id = ''){

        $this->set_redirect();

        $id = esc($id);

        //povecavamo kolicinu uz pomoć petlji
        if(isset($_SESSION['CART'])){

            //Uz pomoć kljuca dodajemo istu stvar u item
            foreach ($_SESSION['CART'] as $key => $item) {
                # code...
                
                if($item['id'] == $id){

                    $_SESSION['CART'][$key]['qty'] -= 1;
                    break;
                }

            }
        }

        $this->redirect();

    }


    //brisanje kolicine
    public function remove($id = ''){

        $this->set_redirect();

        $id = esc($id);

        //povecavamo kolicinu uz pomoć petlji
        if(isset($_SESSION['CART'])){

            //Uz pomoć kljuca dodajemo istu stvar u item
            foreach ($_SESSION['CART'] as $key => $item) {
                # code...
                
                if($item['id'] == $id){

                    unset($_SESSION['CART'][$key]);
                    $_SESSION['CART'] = array_values($_SESSION['CART']);
                    break;
                }

            }
        }

        $this->redirect();


    }

    //function for redirect
    private function redirect(){
    

        header("Location: ". $this->redirect_to);
        die;

    }

    //postavljanje redirecta
    private function set_redirect(){

        //http://localhost/shop/public/cart -> http referer
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ""){
            $this->redirect_to = $_SERVER['HTTP_REFERER'];

        }else{

            $this->redirect_to = ROOT . "shop";
        }
    

    }


}




?>
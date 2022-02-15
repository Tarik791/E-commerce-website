<?php 
//kada napravimo novi page napravimo kontroller za taj page i sljedece sto slijedi jeste kopiramo sve iz home page i paste na taj page

class Contact_us extends Controller {


   public function index(){



    $User = $this->load_model('User');
    $Message = $this->load_model('Message');

    $user_data = $User->check_login();

	if(is_object($user_data)){
        $data['user_data'] = $user_data;
    }
    



    $DB = Database::newInstance();

    //ako je post veći od 0 onda pretpostavljamo da je nešto objavljeno

    $data['errors'] = array();
    if(count($_POST) > 0){

        $data['POST'] = $_POST;
        $data['errors'] = $Message->create($_POST);
        //$ROWS[0]->user_data = $User->get_user($ROWS[0]->user_url);
        if(!is_array($data['errors']) && $data['errors']){
            redirect("contact_us?success=true");
        }
    }


    $data['page_title'] = "Contact-Us";




    $this->view("contact", $data);


    }



}




?>
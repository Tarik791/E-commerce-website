<?php 
//kada napravimo novi page napravimo kontroller za taj page i sljedece sto slijedi jeste kopiramo sve iz home page i paste na taj page
class Post extends Controller {


   public function index($url_address = ''){


    //sadrzi sve postavke u formatu objekta
    //$data['SETTINGS'] = $this->get_all_settings_as_object();


    //postavljamo find u get metodu, vezano za search(u koliko zelimo search bar na stranici postaviti ovo i stavku dva)
    $search = false;

    if(isset($_GET['find'])){

        $find = addslashes($_GET['find']);
        $search = true;
    }


    


    $User = $this->load_model('User');
    $image_class = $this->load_model('Image');
    $user_data = $User->check_login();

    if(is_object($user_data)){

    $data['user_data'] = $user_data;


    }


    $DB = Database::newInstance();


    //search bar(stavka dva)
    if($search){

        //pretraživanje se vrši po deskripciji
        $arr['title'] = "%" . $find . "%";
        $ROWS = $DB->read("select * from blogs where title like :title ", $arr);

        
    }else{
        $arr = array();
        $arr['url_address'] = $url_address;
        $ROWS = $DB->read("select * from blogs where url_address = :url_address limit 1", $arr);


    }
    
    $data['page_title'] = "Post - Unknown";

    if($ROWS){

        $data['page_title'] = $ROWS[0]->title;

            //velicina fotografije proizvoda
            //$ROWS[0]->image = $image_class->get_thumb_blog_post($ROWS[0]->image);

            $ROWS[0]->user_data = $User->get_user($ROWS[0]->user_url);
        

    }


    //get all categories
    $category = $this->load_model('Category');
    $data['categories'] = $category->get_all();

    //get all slider content
    $Slider = $this->load_model('Slider');
    $data['slider'] = $Slider->get_all();

    $data['row'] = $ROWS[0];
    //podaci za search bar(i stavku tri)
    $data['show_search'] = true;
    $this->view("single_post", $data);


    }



}




?>
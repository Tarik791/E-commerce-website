<?php 
//kada napravimo novi page napravimo kontroller za taj page i sljedece sto slijedi jeste kopiramo sve iz home page i paste na taj page

class Blog extends Controller {


   public function index(){

    //for pagination
    $limit = 2;
    $offset = Page::get_offset($limit);

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
    $user_data = $User->check_login(true, ["admin", "customer"]);

    if(is_object($user_data)){

    $data['user_data'] = $user_data;


    }


    $DB = Database::newInstance();


    //search bar(stavka dva)
    if($search){

        //pretraživanje se vrši po deskripciji
        $arr['title'] = "%" . $find . "%";
        $ROWS = $DB->read("select * from blogs where title like :title limit $limit offset $offset", $arr);

        
    }else{

        $ROWS = $DB->read("select * from blogs order by id desc limit $limit offset $offset");


    }
    
    $data['page_title'] = "Blog";

    if($ROWS){
        foreach ($ROWS as $key => $row) {

            //velicina fotografije proizvoda
            $ROWS[$key]->image = $image_class->get_thumb_blog_post($ROWS[$key]->image);
            $ROWS[$key]->user_data = $User->get_user($ROWS[$key]->user_url);
        }

    }


    //get all categories
    $category = $this->load_model('Category');
    $data['categories'] = $category->get_all();

    //get all slider content
    $Slider = $this->load_model('Slider');
    $data['slider'] = $Slider->get_all();

    $data['ROWS'] = $ROWS;
    //podaci za search bar(i stavku tri)
    $data['show_search'] = true;
    $this->view("blog", $data);


    }



}




?>
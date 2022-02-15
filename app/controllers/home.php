<?php 
//kada napravimo novi page napravimo kontroller za taj page i sljedece sto slijedi jeste kopiramo sve iz home page i paste na taj page

class Home extends Controller {


   public function index(){
       //pagination formula
       $limit = 10;
      $offset = Page::get_offset($limit);
      

    //sadrzi sve postavke u formatu objekta
    //$data['SETTINGS'] = $this->get_all_settings_as_object();


    //postavljamo find u get metodu, vezano za search(u koliko zelimo search bar na stranici postaviti ovo i stavku dva)
    $search = false;


    if(isset($_GET['search'])){

        //show($_GET);
        $search = true;
  }


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

    $data['page_title'] = "Home";

    //READ MAIN POSTS
    //search bar(stavka dva)
    if($search){

        if(isset($_GET['find'])){

        //pretraživanje se vrši po deskripciji
        $arr['description'] = "%" . $find . "%";
        $ROWS = $DB->read("select * from products where description like :description limit $limit offset $offset", $arr);

        }else{
            //advanced search
				//generate a search query
				$query = Search::make_query($_GET,$limit,$offset);
				$ROWS = $DB->read($query);
        }
      
        
    }else{

        $ROWS = $DB->read("select * from products limit $limit offset $offset");


    }
    

    if($ROWS){
        foreach ($ROWS as $key => $row) {

            //velicina fotografije proizvoda
            $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);

        }

    }

    $data['ROWS'] = $ROWS;

    //carousel posts page 1
    //postaviti koliko želimo stranica za recommended items
    $carousel_pages_count = 3;

    for($i=0; $i < $carousel_pages_count; $i++) {
        //ubacujemo u recommendded items 3 rand stavke
        $Slider_ROWS[$i] = $DB->read("select * from products where rand() limit 3");      
    
        if($Slider_ROWS[$i]){
            foreach ($Slider_ROWS[$i] as $key => $row) {
    
                //velicina fotografije proizvoda
                $Slider_ROWS[$i][$key]->image = $image_class->get_thumb_post($Slider_ROWS[$i][$key]->image);
    
            }
    
        }
    
    
        $data['Slider_ROWS'][] = $Slider_ROWS[$i];
    }



    //get all categories
    $category = $this->load_model('Category');
    $data['categories'] = $category->get_all();

    //get products for lower segment
    $data ['segment_data'] = $this->get_segment_data($DB,$data['categories'], $image_class);

    //get all slider content
    $Slider = $this->load_model('Slider');
    $data['slider'] = $Slider->get_all();

    if($data['slider']){
        foreach ( $data['slider'] as $key => $row) {

            //velicina fotografije proizvoda
            $data['slider'][$key]->image = $image_class->get_thumb_post($data['slider'][$key]->image, 484, 441);

        }

    }

    //podaci za search bar(i stavku tri)
    $data['show_search'] = true;
    $this->view("index", $data);


    }

    private function get_segment_data($DB,$categories,$image_class)
	{

		$results = array();
		$mycats = array();
		$num = 0;
        if(is_array($categories) || is_object($categories)){

    
		foreach ($categories as $cat) {
			// code...

			$arr['id'] = $cat->id;
			$ROWS = $DB->read("select * from products where category = :id order by rand() limit 5",$arr);
			if(is_array($ROWS))
			{

				$cat->category = str_replace(" ", "_", $cat->category);
				$cat->category = preg_replace("/\W+/", "", $cat->category);

				//crop images
				foreach ($ROWS as $key => $row) {
					# code...
					$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
				}

				$results[$cat->category] = $ROWS;

				$num++;
				if($num > 5){
					break;
				}

			}
		}

    }

		return $results;
	}


}



?>
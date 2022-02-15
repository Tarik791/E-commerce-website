<?php 
//1.(ovo je stavka 1) 2.(home posjeti home)kada kreiramo novi page moramo napraviti controller za taj page


class Admin extends Controller {


   public function index(){

    $User = $this->load_model('User');
        //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)

    $user_data = $User->check_login(true, ["admin"]);

    if(is_object($user_data)){

    $data['user_data'] = $user_data;


    }


    $data['page_title'] = "Admin";
    $data['current_page'] = "dashboard";
    $this->view("admin/index", $data);


    }


    //method for categories
    public function categories(){

        //dodavanje klase iz foldera models
        $User = $this->load_model('User');
            //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
    
        $user_data = $User->check_login(true, ["admin"]);
    
        if(is_object($user_data)){
    
        $data['user_data'] = $user_data;
    
    
        }

        $DB = Database::newInstance();        

        $limit = 10;
        $offset = Page::get_offset($limit);

        $categories_all = $DB->read("select * from categories order by id desc limit $limit offset $offset");


        $categories = $DB->read("select * from categories where disabled = 0 order by id desc limit $limit offset $offset");


        $category = $this->load_model("Category");
        $tbl_rows = $category->make_table($categories_all);
        $data['tbl_rows'] = $tbl_rows;
        $data['categories'] = $categories;

     
        

        $data['page_title'] = "Admin - Categories";
        $data['current_page'] = "categories";
        $this->view("admin/categories", $data);
    
    
        }


            //method for categories
    public function products(){

        $search = false;
        if(isset($_GET['search'])){

            //show($_GET);
            $search = true;
    }
        //dodavanje klase iz foldera models
        $User = $this->load_model('User');
            //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
    
        $user_data = $User->check_login(true, ["admin"]);
    
        if(is_object($user_data)){
    
        $data['user_data'] = $user_data;
    
    
        }
    
        $DB = Database::newInstance();

        $limit = 10;
        $offset = Page::get_offset($limit);


        if($search){

          
            //Generate a search query
            $query = Search::make_query($_GET);
            $products = $DB->read($query);
        }else{

            $products = $DB->read("SELECT prod.*,brands.brand as brand_name, cat.category as category_name FROM products as prod join brands on brands.id = prod.brand join categories as cat on cat.id = prod.category order by prod.id desc limit $limit offset $offset");


        }


        $categories = $DB->read("select * from categories where disabled = 0 order by views desc");

        $brands = $DB->read("select * from brands where disabled = 0 order by views desc");

        //ucitavanje modela
        $product = $this->load_model("Product");
        $category = $this->load_model("Category");


        $tbl_rows = $product->make_table($products, $category);   
        $data['tbl_rows'] = $tbl_rows;
        $data['categories'] = $categories;
        $data['brands'] = $brands;

  

        $data['page_title'] = "Admin - Products";
        $data['current_page'] = "products";

        $this->view("admin/products", $data);
    
    
        }

        public function orders(){

        //korisniski podaci             
        //dodavanje klase iz foldera models
        $User = $this->load_model('User');
        $Order = $this->load_model('Order');

            //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
    
        $user_data = $User->check_login(true, ["admin"]);
    
        if(is_object($user_data)){
    
        $data['user_data'] = $user_data;
    
    
        }

        //dobijamo narudzbe od ovog korisnika
        $orders = $Order->get_all_orders();

        if(is_array($orders)){
            //dodajemo sve kupljene stvari
            foreach ($orders as $key => $row) {
                
                $details = $Order->get_order_details($row->id);
                //vraćamo total iz jedne kolone niza
                $orders[$key]->grand_total = 0;

                if(is_array($details)){

                    $totals = array_column($details, "total");
                    $grand_total = array_sum($totals);
                    $orders[$key]->grand_total = $grand_total;

                }

                //vraćamo zbir svih vrijednosti u nizu 
                $orders[$key]->details = $details;

                $user = $User->get_user($row->user_url);

                $orders[$key]->user = $user;
            }


        }

        //i isporucujemo narudzbe
        $data['orders'] = $orders;

        $data['current_page'] = "orders";

            $data['page_title'] = "Admin - Orders";
            //prikaz
            $this->view("admin/orders", $data);
        }

        //funkcija za priakz korisnika u admin panelu
         function users($type = "customers"){

            //dodavanje klase iz foldera models
            $User = $this->load_model('User');
            $Order = $this->load_model('Order');

            //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
    
            $user_data = $User->check_login(true, ["admin"]);
        
            if(is_object($user_data)){
        
            $data['user_data'] = $user_data;
    
    
        }

        //ako je type jednak adminima
        if($type == "admins"){
            
            $users = $User->get_admins();

        }else{
            //korisnici jednaki korisniku
            $users = $User->get_customers();

        }
            //da li su korisnici niz
            if(is_array($users)){

                foreach($users as $key => $row){

                    //provjeravamo narudzbe za korisnike
                    $orders_num = $Order->get_orders_count($row->url_address);

                    $users[$key]->orders_count = $orders_num;

                }

            }    



            $data['users'] = $users;
            $data['page_title'] = "Admin - $type";
            $data['current_page'] = "users";

            //prikaz stranice
            $this->view("admin/users", $data);

        }   

        function settings($type = ''){
            
        

            //dodavanje klase iz foldera models
            $User = $this->load_model('User');

            //učitavamo settings klasu 
            $Settings = new Settings();

            //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
            $user_data = $User->check_login(true, ["admin"]);
        
            if(is_object($user_data)){
        
            $data['user_data'] = $user_data;
    
    
        }

        //select the right page 
        if($type == "socials"){

            //ako je nešto objavljeno
            if(count($_POST) > 0){

            $errors = $Settings->save_settings($_POST);
                header(("Location: " . ROOT . "admin/settings/socials"));
                die;

            }
                $data['settings'] = $Settings->get_all_settings();
        
        }else //SLIDER IMAGES
            if($type == "slider_images"){

            $data['action'] = "show";

            $Slider = $this->load_model('Slider');
    
            //read all  table slider images
            $data['rows'] = $Slider->get_all();

            //ako je jednaka dodavanju onda dodajemo row
                if(isset($_GET['action']) && $_GET['action'] == "add"){

                $data['action'] = "add";



                //if something was posted
                if(count($_POST) > 0){


                    $Image = $this->load_model('Image');

                    $data['errors'] = $Slider->create($_POST, $_FILES, $Image);


                    $data['POST'] = $_POST;
                    header(("Location: " . ROOT . "admin/settings/slider_images"));
                    die;
                }


            }else //ako je jednaka dodavanju onda editujemo row
                if(isset($_GET['action']) && $_GET['action'] == "edit"){

                    $data['action'] = "edit";
                    $data['id'] = null;
                    if(isset($_GET['id'])){

                        $data['id'] = $_GET['id'];

                    }


            }else  //ako je jednaka dodavanju onda brišemo row row
                if(isset($_GET['action']) && $_GET['action'] == "delete"){

                    $data['action'] = "delete";



            }else 

            if(isset($_GET['action']) && $_GET['action'] == "delete_confirmed"){

            }

        }

            //slanje
            $data['type'] = $type;
            $data['page_title'] = "Admin - $type";
            $data['current_page'] = "settings";
            //prikaz stranice
            $this->view("admin/settings", $data);

        }
        
        function messages($type = ''){


                $type = 'Messages';
            //dodavanje klase iz foldera models
                $User = $this->load_model('User');
                $Message = $this->load_model('Message');
    
                //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
        
                $user_data = $User->check_login(true, ["admin"]);
            
                if(is_object($user_data)){
            
                $data['user_data'] = $user_data;
        
        
            }
                $mode = "read";
                //read postaje delete
                if(isset($_GET['delete'])){


                $mode = "delete";

                }

                //potvrda brisanja
                if(isset($_GET['delete_confirmed'])){


                $mode = "delete_confirmed";
                $id = $_GET['delete_confirmed'];
                $messages = $Message->delete($id);



                }
                
              
           
           //ako je mod jednako delete- , obrisati će se jedan item
           if($mode == "delete"){

            $id = $_GET['delete'];
            $messages = $Message->get_one($id);

           }else{


            $messages = $Message->get_all();

           }

      

               $data['mode'] = $mode;
               $data['messages'] = $messages;

               $data['page_title'] = "Admin - $type";
               $data['current_page'] = "messages";
   
               //prikaz stranice
               $this->view("admin/messages", $data);
   
        }



        function blogs($type = ''){

            

            $type = 'Blogs Posts';
        //dodavanje klase iz foldera models
            $User = $this->load_model('User');
            $post_class = $this->load_model('post');
            $image_class = $this->load_model('Image');

            //lista tipova koji su prihvaćeni na ovoj stranici(ako korisnik nije dio toga zabranjeno je dobiti pristup admin stranice)
    
            $user_data = $User->check_login(true, ["admin"]);
        
            if(is_object($user_data)){
        
            $data['user_data'] = $user_data;
    
    
        }
            $mode = "read";
            //read postaje delete
            if(isset($_GET['delete'])){


            $mode = "delete";

            }

             //read postaje delete
             	if(isset($_GET['add_new'])){
			$mode = "add_new";
		}

             //read postaje delete
             if(isset($_GET['edit'])){
                $mode = "edit";
            }

            

            //potvrda brisanja
            if(isset($_GET['delete_confirmed'])){


            $mode = "delete_confirmed";
            $id = $_GET['delete_confirmed'];
            $posts = $post_class->delete($id);



            }
            
       if($mode == "edit"){

            $id = $_GET['edit'];
            $blogs = $post_class->get_one($id);

            $data['POST'] = (array)$blogs;

       }else
       if($mode == "delete"){

        $id = $_GET['delete'];
        $blogs = $post_class->get_one($id);
        
        if($blogs){
                    
            //ako file postoji
            if(file_exists($blogs->image)){ 

            //velicina fotografije proizvoda
            $blogs->image = $image_class->get_thumb_post($blogs->image);

            }

            //dobijamo korisnika
            $blogs->user_data = $User->get_user( $blogs->user_url);

    }     
    $data['POST'] = (array)$blogs;
      


       }else{


        $blogs = $post_class->get_all();

        $image_class = $this->load_model('Image');

        if($blogs){
            foreach ($blogs as $key => $row) {
                
                //ako file postoji
                if(file_exists($blogs[$key]->image)){ 

                //velicina fotografije proizvoda
                $blogs[$key]->image = $image_class->get_thumb_post($blogs[$key]->image);

                }

                //dobijamo korisnika
                $blogs[$key]->user_data = $User->get_user( $blogs[$key]->user_url);

            }

    
        }

       }

            //if something was posted(save to db)
            if(count($_POST) > 0){

                //dodavanje klase iz foldera models
                $post = $this->load_model('Post');                
                $image_class = $this->load_model('image');

                if($mode == "edit"){

                $post_class->edit($_POST, $_FILES, $image_class);

                }else{

                    $post_class->create($_POST, $_FILES, $image_class);

                }

                if(isset($_SESSION['error']) && $_SESSION['error'] != ""){

                    $data['errors'] = $_SESSION['error'];
                    $data['POST'] = $_POST;

                }else{

                    redirect("admin/blogs");
                }
           }
           $data['mode'] = $mode;
           $data['blogs'] = $blogs;
           $data['page_title'] = "Admin - Blog Posts";
           $data['current_page'] = "blogs";

           //prikaz stranice
           $this->view("admin/blogs", $data);

    }
    


}




?>
<?php 

Class Post {

    //Sačuvamo u bazu podataka
    public function create($DATA,$FILES, $image_class = null){

       

        $_SESSION['error'] = "";
        
       $DB = Database::newInstance();
       $arr['title'] = ucwords($DATA['title']);
       $arr['post'] = ($DATA['post']);
       $arr['date'] = date("Y-m-d H:i:s");
       $arr['user_url'] = $_SESSION['user_url'];
       $arr['url_address'] = str_to_url($DATA['title']);


       //regex for title
       if(!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['title']))){

        $_SESSION['error'] .= "Please enter a valid description for this post<br>";

       }

         //regex for quantity
         if(empty($arr['post'])){

            $_SESSION['error'] .= "Please write a valid content<br>";
    
           }



        //make sure url_address is unique
        $url_address_arr['url_address'] = $arr['url_address'];
		$query = "select url_address from blogs where url_address = :url_address limit 1";
		$check = $DB->read($query,$url_address_arr);

		if($check){
			$arr['url_address'] .= "-" . rand(0,99999);
		}



        $arr['image'] = "";
   

        $allowed[] = "image/jpeg";
        $size = 10;
        $size = ($size * 1024 * 1024);


        $folder = "uploads/";
        
        if(!file_exists($folder)){

            mkdir($folder, 0777, true);

        }

        //check for files
        foreach ($FILES as $key => $img_row) {
            
            if($img_row['error'] == 0 && in_array($img_row['type'], $allowed)){

                if($img_row['size'] < $size){

                    //generiramo random karaktere fotografije da ne bi dobijali duplikate
                    $destination = $folder . $image_class->generate_filename(60) . ".jpg";
                    move_uploaded_file($img_row['tmp_name'], $destination);
                    $arr[$key] = $destination;
                    
                    //resize the image
                   $image_class->resize_image($destination,$destination,1500,1500);


                }else{

                    $_SESSION['error'] .= $key . "is bigger than required size<br>";
                }


            }
        }


    if($arr['image'] == ""){

        $_SESSION['error'] .= " an image than required size<br>";

    }
       if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){

        $query = "insert into blogs (title,post,date,user_url,image,url_address) values (:title,:post,:date,:user_url,:image,:url_address)";

        $check = $DB->write($query, $arr);

        if($check){

        return true;
  
        }

       }
       return false;

      



    } 


        //Sačuvamo u bazu podataka
        public function edit($DATA,$FILES, $image_class = null){

       

        $_SESSION['error'] = "";
            
       $DB = Database::newInstance();
       $arr['title'] = ucwords($DATA['title']);
        $arr['post'] = ($DATA['post']);
        $arr['url_address'] = ($DATA['url_address']);

    
           //regex for title
           if(!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['title']))){
    
            $_SESSION['error'] .= "Please enter a valid description for this post<br>";
    
           }
    
             //regex for quantity
             if(empty($arr['post'])){
    
                $_SESSION['error'] .= "Please write a valid content<br>";
        
               }
    
            $arr2['image'] = "";
       
    
            $allowed[] = "image/jpeg";
            $size = 10;
            $size = ($size * 1024 * 1024);
    
    
            $folder = "uploads/";
            
            if(!file_exists($folder)){
    
                mkdir($folder, 0777, true);
    
            }
    
            //check for files
            foreach ($FILES as $key => $img_row) {
                
                if($img_row['error'] == 0 && in_array($img_row['type'], $allowed)){
    
                    if($img_row['size'] < $size){
    
                        //generiramo random karaktere fotografije da ne bi dobijali duplikate
                        $destination = $folder . $image_class->generate_filename(60) . ".jpg";
                        move_uploaded_file($img_row['tmp_name'], $destination);
                        $arr2[$key] = $destination;
                        
                        //resize the image
                       $image_class->resize_image($destination,$destination,1500,1500);
    
    
                    }else{
    
                        $_SESSION['error'] .= $key . "is bigger than required size<br>";
                    }
    
    
                }
            }
    
    
           if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
    
            if($arr2['image'] == ""){
                
                $query = "update blogs  set title = :title,post = :post where url_address = :url_address limit 1";
        
            }else{
                $arr['image'] = $arr2['image'];

                $query = "update blogs  set title = :title,post = :post,image = :image where url_address = :url_address limit 1";

            }
    
            $check = $DB->write($query, $arr);
    
            if($check){
    
            return true;
      
            }
    
           }
           return false;
    
          
    
    
    
        } 


    
    //Brisanje u bazu podataka
    public function delete($url_address){

        
        $DB = Database::newInstance();
        $arr['url_address'] = $url_address;
        $query = "delete from blogs where url_address = :url_address limit 1";
        $DB->write($query, $arr);

    } 


    //Dobijamo podatke
    public function get_one($url_address)
    {

        $arr['url_address'] = $url_address;

        $DB = Database::newInstance();
        $data = $DB->read("select * from blogs where url_address = :url_address limit 1", $arr);
        return $data[0];
    }

	//Dobijamo podatke
	public function get_all(){
        
        //pagination
        $limit = 4;
        $offset = Page::get_offset($limit);
        
		$DB = Database::newInstance();
		return $DB->read("select * from blogs order by id desc limit $limit offset $offset");
		



	} 


    
        


}


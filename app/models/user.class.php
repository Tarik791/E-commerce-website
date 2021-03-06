<?php


class User{

    private $error = "";
    //Funckija za prijavu korisnika
    public function signup($POST){

        $data = array();
        $db = Database::getInstance();


        $data['name'] = trim($POST['name']);
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);
        $password2 = trim($POST['password2']);

        if(empty($data['email']) || !preg_match("/^[a-zA-Z]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {

            $this->error .= "Please enter a valid email <br>";

        }

        if(empty($data['name']) || !preg_match("/^[a-zA-Z ]*$/", $data['name'])) {

            $this->error .= "Please enter a valid name <br>";

        }

        if($data['password'] !== $password2 ){


            $this->error .= "Passwords do not match <br>";


        }

        //Password mora imati najmanje 4 karaktera
        if(strlen($data['password']) < 4){


            $this->error .= "Password must be atelaast 4 characters long <br>";


        }


        //check if email alredy exists
        $sql = "select * from users where email = :email limit 1";
        $arr['email'] = $data['email'];

        $check = $db->read($sql, $arr);

        if(is_array($check)){

            $this->error .= "That email is alredy in use <br>";


        }

        $data['url_address'] = $this->get_random_string_max(60);

        //check for url address

        $arr = false;

        $sql = "select * from users where url_address = :url_address limit 1";
        $arr['url_address'] = $data['url_address'];

        $check = $db->read($sql, $arr);

        if(is_array($check)){



            $data['url_address'] = $this->get_random_string_max(60);


        }


        if($this->error == ""){
            //save
            $data['rank'] = "customer";
            $data['date'] = date("Y-m-d H:i:s");
            $data['password'] = hash('sha1', $data['password']);

            $query = "insert into users (url_address, name, email, password, rank, date) values (:url_address, :name, :email, :password, :rank, :date)";

            //instanciramo bazu podataka
            $result = $db->write($query,$data);
            
            if($result){

                header("Location: " . ROOT . "login");

                die;
            }
        }

        $_SESSION['error'] = $this->error;


    }

    //Funckija za Login korisnika
    public function login($POST){



        $data = array();
        $db = Database::getInstance();


        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);

        if(empty($data['email']) || !preg_match("/^[a-zA-Z]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {

            $this->error .= "Please enter a valid email <br>";

        }

      

        //Password mora imati najmanje 4 karaktera
        if(strlen($data['password']) < 4){


            $this->error .= "Password must be atelaast 4 characters long <br>";


        }


   


        if($this->error == ""){
            //confirm
            $data['password'] = hash('sha1', $data['password']);

              //check if email alredy exists
        $sql = "select * from users where email = :email && password = :password limit 1";

        $result = $db->read($sql, $data);

        if(is_array($result)){

            $_SESSION['user_url'] = $result[0]->url_address;

            if(isset($_SESSION['intended_url'])){

                $url = $_SESSION['intended_url'];
                unset($_SESSION['intended_url']);

                header("Location: " . $url);

            }else{

                header("Location: " . ROOT . "home");
            }

            die;

    
       
            }
            
            
            $this->error .= "Wrong email or password! <br>";
        }

        $_SESSION['error'] = $this->error;



    }

    //Dovo??enje jednog korisnika
    public function get_user($url){


        $db = Database::newInstance(); 
        $arr = false;
        
        $arr['url'] = addslashes($url);
        $query = "select * from users where url_address = :url limit 1";
        
        $result = $db->read($query, $arr);
        
        if(is_array($result)){

            return $result[0];

        }

        return false;

    }


    //Dovo??enje jednog kupca
    public function get_customers(){


        $db = Database::newInstance(); 
        $arr = false;
        
        $arr['rank'] = "customer";
        $query = "select * from users where rank = :rank";
        
        $result = $db->read($query, $arr);
        
        if(is_array($result)){

            return $result;

        }

        return false;

    }


    //Dovo??enje jednog admina
    public function get_admins(){


        $db = Database::newInstance(); 
        $arr = false;
        
        $arr['rank'] = "admin";
        $query = "select * from users where rank = :rank";
        
        $result = $db->read($query, $arr);
        
        if(is_array($result)){

            return $result;

        }

        return false;

    }



    private function get_random_string_max($length){

        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $text = "";

        $length = rand(4, $length);

        for($i=0; $i<$length; $i++){
            $random = rand(0,61);

            $text .= $array[$random];
        }

        return $text;

    }

    //provjera prijave
    public function check_login($redirect = false, $allowed = array())
	{

		$db = Database::getInstance();

		if(count($allowed) > 0){
		
			$arr['url'] = isset($_SESSION['user_url']) ? $_SESSION['user_url'] : '' ;
			$query = "select * from users where url_address = :url limit 1";
			$result = $db->read($query,$arr);
				
			if(is_array($result))
			{
				$result = $result[0];
				if(in_array($result->rank, $allowed)){

					return $result;
				}

			}
			
			$_SESSION['intended_url'] = FULL_URL; 
			header("Location: " . ROOT . "login");
			die;
 
		}else{
			 
	 		if(isset($_SESSION['user_url']))
			{
				$arr = false;
				$arr['url'] = $_SESSION['user_url'];
				$query = "select * from users where url_address = :url limit 1";

				$result = $db->read($query,$arr);
				
				if(is_array($result))
				{
					return $result[0];
				}
			}

			if($redirect){
				$_SESSION['intended_url'] = FULL_URL; 
				header("Location: " . ROOT . "login");
				die;
			}
		}

		return false;

	}
    //Funkcija za odjavu korisnika
    public function logout(){

        //Uklanjamo user_url iz sessije
        if(isset($_SESSION['user_url'])){

            unset($_SESSION['user_url']);
        }

        header("Location: " . ROOT . "home");
        die;

    }

}


?>
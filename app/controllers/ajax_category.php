<?php 

class Ajax_category extends Controller {


   //šaljemo podatke iz ajax kontrolera
   public function index(){


    //hvatamo podatke
    $_SESSION['error'] = "";

    $data = file_get_contents("php://input");
    $data = json_decode($data);

    //šaljemo podatke
    if(is_object($data) && isset($data->data_type)){

        $DB = Database::getInstance();
        $category = $this->load_model('Category');

        //Dodavanje kategorije
        if($data->data_type == 'add_category')
        {

            //add new category
            $check = $category->create($data);
            
            if($_SESSION['error'] != "")
            {
                
                //error
                $arr['message'] = $_SESSION['error'];
                $_SESSION['error'] = "";
                $arr['message_type'] = "error";
                $arr ['data'] = "";
                $arr ['data_type'] = "add_new";

             
                echo json_encode($arr);

            }else{

                //info
                $arr['message'] = "Category added successfully!";
                $arr['message_type'] = "info";
                $cats = $category->get_all();
                $arr['data'] = $category->make_table($cats);
                $arr['data_type'] = "add_new";


                echo json_encode($arr);


            }
        }else
        if($data->data_type == 'disable_row')
        {

        //da li je omogućeno ili neomogućeno stanje
        $disabled = ($data->current_state == "Enabled") ? 1 : 0;

        $id = $data->id;

        $query = "update categories set disabled = '$disabled' where id = '$id' limit 1";
        $DB->write($query);

          //error
          $arr['message'] = "";
          $_SESSION['error'] = "";
          $arr['message_type'] = "info";

          $cats = $category->get_all();
          $arr['data'] = $category->make_table($cats);

          $arr['data_type'] = "disable_row";

       
          echo json_encode($arr);


        }else
        if($data->data_type == 'edit_category'){


            //error
            $category->edit($data);
            $arr['message'] = "Your row was successfully edited";
            $_SESSION['error'] = "";
            $arr['message_type'] = "info";


            $cats = $category->get_all();
            $arr['data'] = $category->make_table($cats); 
             
            $arr['data_type'] = "edit_category";

            echo json_encode($arr);



        }else
        if($data->data_type == 'delete_row')

        {
               //error
               $category->delete($data->id);
               $arr['message'] = "Your row was successfully deleted";
               $_SESSION['error'] = "";
               $arr['message_type'] = "info";


               $cats = $category->get_all();
               $arr['data'] = $category->make_table($cats); 
                
               $arr['data_type'] = "delete_row";

               echo json_encode($arr);

        }


    }

    }





}




?>
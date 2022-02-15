<?php


Class Settings{

    private $error = array();
    protected static $SETTINGS = null;

    //dobijamo sve postavke
    public function get_all_settings(){


        $db = Database::newInstance();
        $query = "select * from settings";
        return $db->read($query);

    }

    //funkcija koja će se pokrenuti kada pokusamo pristupiti funkciji koja ne postoji, sada osnovna funkcija radi samo ako smo kreirali instancu
   static function  __callStatic($name, $params){

        //ako postavke funkcioniraju 
        if(self::$SETTINGS){

            $settings = self::$SETTINGS;

        }else{

        //čitamo iz baze podataka
        $settings = self::get_all_settings_as_object();
        }

        

        if(isset($settings->$name)){

            return $settings->$name;

        }

        return "";
    }

    //dobijamo sve postavke kao jedan objekt
    public static function get_all_settings_as_object(){

        $db = Database::newInstance();
        $query = "select * from settings";
        $data = $db->read($query);

        //niz koji stvaramo ali ga pretvaramo u objekt
        $settings = (object)[];

        //ako je data array
        if(is_array($data)){

            foreach($data as $row) {
                $setting_name = $row->setting;
                $settings->$setting_name = $row->value;
            }

        }

        //spremanje za bazu podataka
        self::$SETTINGS = $settings;
        return $settings;
        
    }


    public function save_settings($POST){

     $this->error = array();

    $db = Database::newInstance();
    
    foreach ($POST as $key => $value) {
        
        $arr = array();
        $arr['setting'] = $key;


        if(strstr($key, "_link")){

            //spremamo vezu socijalnih ikona linka sa http-om
            if(trim($value) != "" && !strstr($value, "https://")){

                $value = "https://" . $value;

            }
            $arr['value'] = $value;

        }else{

            $arr['value'] = $value;


        }

        $query = "update settings set value = :value where setting = :setting limit 1";
      
        $db->write($query, $arr);

        }   
        
        return $this->error;

    }

}




?>
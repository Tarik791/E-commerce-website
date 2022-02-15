<?php 

/**
 * search for stuff
 */

class Search {

    function __construct(){


    }

    public static function get_categories(){

        $DB = Database::getInstance();

        $query = "select id,category from categories where disabled = 0 order by views desc ";
        $data = $DB->read($query);

        if(is_array($data)) {

            foreach ($data as $row) {
                
                echo "<option id='$row->id'>$row->category</option>";
            }

        }

    }


}

?>
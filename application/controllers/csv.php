<?php
class CSV extends CI_Model
{
    public function insert()
    {
        $conn = mysqli_connect("localhost", "root","", "project_two");
        if (isset($_POST["import"])) {
            $fileName = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0) { 
                $file = fopen($fileName, "r");
                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $sqlInsert = "INSERT into user_files (first_name, last_name, phone, email)
                        values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "')";
                    $result = mysqli_query($conn, $sqlInsert);
                    
                    if (! empty($result)) {
                        $type = "success";
                        $message = "CSV Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing CSV Data";
                    }
                }
            }
        }
    }
}
?>
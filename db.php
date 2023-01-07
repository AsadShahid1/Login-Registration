<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
    class Database{
        protected $table;
        protected $con;
        // construtor 
        // => for table in which Insert
        // => for dynamic data base connection
        public function __construct($db , $table){
            $this->table = $table;
            $this->con = mysqli_connect('localhost' , 'root' , '' , $db);
        }
        
        // function for select--->
        public function select(){  
           $array = array();  
           $sql = "SELECT * FROM  $this->table";  
           $query = mysqli_query($this->con, $sql);  
           while($row = mysqli_fetch_assoc($query))  
           {  
                $array[] = $row;  
           }  
           return $array;  
         }  

        // function (insert function)--->
        public function insert($array){
            $columns = "";
            $values = "";
            foreach ($array as $key => $value) {
                $columns .= $key . ",";
                $values .= "'" . $value . "',";
            }
            $columns = trim($columns , ",");
            $values = trim($values , ","); 
            $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
            $query = mysqli_query($this->con , $sql);
            if($query){
                echo "<div class='alert alert-info'>Successfully insert</div>";
            }
            else{
                echo mysqli_error($this->con);
            }
        }

      // function (update function)--->
      public function update($array,$wkey , $id){
       $update="";
        foreach ($array as $key => $value) {
           $update .= $key. "='" . $value . "' ,";
        }
        $update = trim($update , ",");
        $sql = "UPDATE $this->table SET ".$update." WHERE $wkey = '$id'";
        // echo $sql;
        // die;
        $query = mysqli_query($this->con , $sql);
        if($sql){
            echo "<div class='container alert alert-info'>Successfully update</div>";
        }  
        else{
            echo mysqli_error($this->con);
        }
    }
 
        // function (delete function)--->
        public function delete($key , $id){
            $sql = "DELETE FROM $this->table WHERE $key = '$id'";
            $query = mysqli_query($this->con , $sql);
            if($sql){
                echo "<div class='container alert alert-info'>Successfully delete</div>";
            }
            else{
                echo mysqli_error($this->con);
            }
        }


        // Email validation function--->
        public function check($column , $value , $pk = "" , $id = 0){
            if($id == 0)
                $sql = "SELECT * FROM  $this->table WHERE $column = '$value'";
            else
                $sql = "SELECT * FROM  $this->table WHERE $column = '$value' AND $pk != '$id'";
            $query = mysqli_query($this->con , $sql);
            $row = mysqli_num_rows($query);
            if($row > 0){
                return false;
            }
            return true;
        }

         // function of login--->
         public function login($email , $pwd , $check= false){
            $sql = "SELECT * FROM  $this->table WHERE email = '$email' AND pwd = '$pwd'";
            $query = mysqli_query($this->con , $sql);
            if(mysqli_num_rows($query) > 0){
                $user = mysqli_fetch_assoc($query);
                $_SESSION['id'] = $user['id'];
                if($check)
                    setcookie('id', $user['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                return true;
            }
        
            return false;
        }


        // function get login user data--->
        public function get_login_user(){
            if(isset($_SESSION['id'])){
                $id =  $_SESSION['id'];
            }else if(isset($_COOKIE['id'])){
                $id =  $_COOKIE['id'];
            }
            return $id;

        }

        
        // function the user is login or not--->
            public function is_login(){
                if(isset($_SESSION['id']) || isset($_COOKIE['id'])){
                    return true;
                }
                return false;
            }

    }

    session_start();
      
?>

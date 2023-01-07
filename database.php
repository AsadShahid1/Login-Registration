<?php
    

    class Database{
        protected $table;
        protected $con;
        public function __construct($db , $table){
            $this->table = $table;
            $this->con = mysqli_connect('localhost' , 'root' , '' , $db);
        }   

        public function select(){
            $array = array();
            $sql = "SELECT * FROM $this->table";
            $query = mysqli_query($this->con , $sql);
        
        while($row = mysqli_fetch_assoc($query))
        {
            $array[] = $row;
        }
        return $array;
    }

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
        public function is_login(){
            if(isset($_SESSION['id']) || isset($_COOKIE['id'])){
                return true;
            }
            return false;
        }

        public function get_login_user(){
            if(isset($_SESSION['id'])){
                $id =  $_SESSION['id'];
            }else if(isset($_COOKIE['id'])){
                $id =  $_COOKIE['id'];
            }
            return $id;

        }
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
            if(!$query){
                echo mysqli_error($this->con);
            }else{
                echo "Registered Sccessfully";
            }
        }

        public function update($array, $wkey , $id){
            $update = "";
            foreach($array as $key=> $value){
                $update .= $key ."='" . $value . "' ,";
            }
            $update = trim($update , ",");
            $sql = "UPDATE $this->table SET ". $update." WHERE $wkey = '$id'";
            $query = mysqli_query($this->con , $sql);
        }

        public function delete($key , $id){
            $sql = "DELETE FROM $this->table WHERE $key = '$id'";
            $query = mysqli_query($this->con , $sql);
        }
    }
    session_start();
    $obj = new Database('batch' , 'students');
    // $obj->insert(array('name' => "Mamoona" , 'roll_num' => 23 , 'email' => 'm@m.com' , 'program' => "MSCS" , 'department' => 'Management Science'));

    // $obj->update(array('name' => "Sheikh" , 'roll_num' => 23 , 'email' => 'm@m.com' , 'program' => "MSCS" , 'department' => 'Management Science'), 'id' , 25);
    // $obj_two = new Database('batch' , 'users');
    // $obj_two->insert(array('name' => "Mamoona" , 'email' => 'm@m.com' , 'Password' => "pass" , 'Confirm password' => 'pass' , 'Description' => "<h1>Hello</h1>"));
    // echo "<pre/>";
    // print_r($obj->select());
    // $obj->delete('id' , 23);
    // $obj->check();
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('db.php');
$obj = new Database('batch' , 'users');
if($obj->is_login())
    header("location:profile.php");
    if(isset($_POST['submit'])){
        extract($_POST);
        if(isset($check)){
            if(isset($name) && !empty(trim($name))){
                if(isset($email) && !empty(trim($email))){
                    if(isset($pwd) && !empty(trim($pwd))){
                        if(isset($cpwd) && !empty(trim($cpwd))){
                            if(trim($pwd) == trim($cpwd)){
                                unset($_POST['submit']);
                                unset($_POST['cpwd']);
                                unset($_POST['check']);
                                if($obj->check('email', $_POST['email']))
                                    $obj->insert($_POST);
                            }else{
                                $conpwd_error = "Password & Confirm Password doesn't Match";
                            }
                        }else{
                            $cpwd_error = "Confirm Password is required";
                        }    
                    }else{
                        $pwd_error = "Password is required";
                    }    
                }else{
                    $email_error = "Email is required";
                }    
            }else{
                $name_error = "Name is required";
            }
        }else{
            $check_error = "You must Accept our Terms $ Conditions";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <style>
      .invalid-feedback{
          display:block;
      }
      .invalid{
          border : 1px solid red;
      }
  </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center text-info">Form Validation</h1>

        <form class="row g-3 needs-validation" method="post" novalidate>
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Name</label>
                <input name="name" type="text" 

                    <?php
                        if(isset($name_error)){
                    ?>
                    class="form-control invalid" 
                    <?php
                        }else{
                    ?>
                    class="form-control"
                    <?php
                        }
                    ?>

                    <?php
                        if(isset($name)){
                            ?>
                            value="<?= $name ?>"
                            <?php
                        }
                    ?>

                
                
                id="validationCustom01" placeholder="Mark" required>
                <div class="invalid-feedback">
                <?php
                            if(isset($name_error)){
                                echo $name_error;
                            }
                            ?>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">Email</label>

                <div class="input-group">

                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input name="email" type="email"
                
                
                <?php
                        if(isset($email_error)){
                    ?>
                    class="form-control invalid" 
                    <?php
                        }else{
                    ?>
                    class="form-control"
                    <?php
                        }
                    ?> 
                
                <?php
                        if(isset($email)){
                            ?>
                            value="<?= $email ?>"
                            <?php
                        }
                    ?>
                
                id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        
                    <?php
                            if(isset($email_error)){
                                echo $email_error;
                            }
                            ?>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">Password</label>
                <div class="input-group">
                <input name="pwd" type="password" 
                
                <?php
                        if(isset($pwd_error) || isset($conpwd_error)){
                    ?>
                    class="form-control invalid" 
                    <?php
                        }else{
                    ?>
                    class="form-control"
                    <?php
                        }
                    ?>

                id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                        <?php
                            if(isset($pwd_error)){
                                echo $pwd_error;
                            }if(isset($conpwd_error)){
                                echo $conpwd_error;
                            }
                        ?>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">Confirm Password</label>
                <div class="input-group">
                <input  name="cpwd" type="password" 
                
                
                <?php
                        if(isset($cpwd_error) || isset($conpwd_error)){
                    ?>
                    class="form-control invalid" 
                    <?php
                        }else{
                    ?>
                    class="form-control"
                    <?php
                        }
                    ?>
                
                
                id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                <?php
                            if(isset($cpwd_error)){
                                echo $cpwd_error;
                            }if(isset($conpwd_error)){
                                echo $conpwd_error;
                            }
                            ?>
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">Description</label>
                <div class="input-group">
                    <textarea name="description" class="form-control"><?php if(isset($description)) echo $description;  ?></textarea>
                    <div class="invalid-feedback">
                    
                </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" <?php if(isset($check)) echo "checked" ?> type="checkbox" value="" id="invalidCheck" required name="check">
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    <?php
                        if(isset($check_error)){
                            echo $check_error;
                        }
                    ?>
                </div>
                </div>
            </div>
            <?php
            if(isset($great)){
            ?>
            <div class="alert alert-success"><?= $great ?></div>
            <?php
            }
            ?>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
            </div>
        </form>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>
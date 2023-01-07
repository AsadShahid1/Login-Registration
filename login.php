<?php
include('db.php');
$obj = new Database('batch' , 'users');
if($obj->is_login())
    header("location:profile.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');
    if(isset($_POST['login'])){
        extract($_POST);
                if(isset($email) && !empty(trim($email))){
                    if(isset($pwd) && !empty(trim($pwd))){
                                unset($_POST['submit']);
                                unset($_POST['cpwd']);
                                unset($_POST['check']);
                                if(isset($check)){
                                    if($obj->login($email , $pwd , true))
                                        header('location:profile.php');
                                }else if($obj->login($email , $pwd))
                                  header('location:profile.php');
                                else
                                    $msg = "Credentials doen't match our record";
                            
                    }else{
                        $pwd_error = "Password is required";
                    }    
                }else{
                    $email_error = "Email is required";
                }    
            }
     
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Asad Shahid-->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" name="email" class="form-control <?php if(isset($email_error)){ ?> invalid <?php } ?>" placeholder="email">
						<div class="invalid-feedback">
                        
                    <?php
                            if(isset($email_error)){
                                echo $email_error;
                            }
                            ?>
                    </div>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="pwd" class="form-control <?php if(isset($pwd_error)){ ?> invalid <?php } ?>" placeholder="password">
                        <div class="invalid-feedback">
                        
                    <?php
                            if(isset($pwd_error)){
                                echo $pwd_error;
                            }
                            ?>
                    </div>
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox" name="check">Remember Me
					</div>
					<div class="form-group">
						<input type="submit" value="Login" name="login" class="btn float-right login_btn">
					</div>
                    <?php
                        if(isset($msg)){
                            ?>
                                <div class="alert alert-danger"><?= $msg ?></div>
                            <?php
                        }
                    ?>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
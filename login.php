<?php 
  session_start();
  require 'include/db.connect.php';
  require 'include/Validation.php';
 
  if(isset($_POST['submit'])){
        $validation=new Loginval($_POST);
	

         $userName=$_POST['userName'];
         $password =$_POST['password'];
	
	//Checking if the username and passwords are correct or not
 	$login=new CheckFields();
	$userExist=$login->check("SELECT * FROM `users_info` WHERE  `userName` = '$userName' AND `password` = '$password'");
	if($userExist>0){

 		$_SESSION['login'] = true;  
		$_SESSION['userName'] = $userName;    
 		//echo $_SESSION['userName'];
 		header("Location:Quora.php");
		 echo 'sucessfull';
 	}
	else{
		$validation->addError("invalid","invalid username or password");
	}
	$errors=$validation->validateForm();//Returning the $error array
	//echo $errors['userName'];
     }

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="css/navbar.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
		crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
		crossorigin="anonymous">
	</script>
	<title>Quora login</title>
</head>

<body>

 <?php include 'partials/navbar.php';
?>


	<div class="left">
		<div class="container">
			<form name="loginForm" action="login.php" method="POST">
				<div class="log-center my-3">
					<img src="icon/conversation.png" height="50px" width="50px"
						alt=""><strong>Quora</strong>
				</div>

				<div class="log-center">
					<span>Log in</span>
				</div>

				<div class="form-group input ">
					<label class="" for="exampleInputEmail1 p-2 ">UserName</label>
					<input type="text" class="form-control p-3" id="userName" name="userName"
						aria-describedby="emailHelp"
						placeholder="Enter username">
				</div>
				<div class="error">
				<?php echo $errors['userName'] ?? ''; ?>
				</div>

				<div class="form-group mt-4 p  input">
					<div class="forgot">
						<label for="exampleInputPassword1">Password</label>
						<label for="exampleInputPassword1"><a href="">Forgot
								Password</a></label>
					</div>
					<input type="password" class="form-control p-3" id="password"
						 name="password" placeholder="Password">
				</div>
				<div class="error">
					 <?php echo $errors['password'] ?? ''; ?>
				</div>


				<div class="button-bottom">
					<button type="submit" name="submit" class="btn btn-success ">Login</button>
				</div>
				<div class="error text-center my-2">
					 <?php echo $errors['invalid'] ?? ''; ?>
				</div>

				
			</form>
		</div>
	</div>
</body>

</html>
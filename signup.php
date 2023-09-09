 <?php
    session_start();
    require 'include/db.connect.php';
    require 'include/Validation.php';

    if(isset($_POST['submit'])){//If the Sbumit button is set exexcute code below
	// variables for input data
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
        $userName = $_POST['userName'];
	$email = $_POST['email'];
	$password =md5($_POST['password']);
    
     //Creating object for checking username availvity
    $checkUsername=new CheckFields();
    $checkEmail=new CheckFields();
    $userNameResult=$checkUsername->check("SELECT * FROM `users_info` where `userName`='$userName'");
    $emailResult=$checkEmail->check("SELECT * FROM `users_info` where `email_id`='$email'");

    //Creating object of validation class for validating the form
    $validation=new Signup($_POST);//Passing all the posts value to UserValidation class

    //Passing the value to addError function because userName already exists
    if($userNameResult>0){
	$validation->addError("userName","username already exists");
    }
    //Passing the value to addError function because email already exists
    if($emailResult>0){
	$validation->addError("email","email already exists");
    }
    $errors=$validation->validateForm();

     //If no error insert data to db
     if($errors==null){
       
     //Saving the data to database
    session_start();
    $_SESSION['Sign_Success']="true";
    $insertData=new InsertData();
    $result= $insertData->query("INSERT INTO `users_info` (`userName`, `email_id`, `firstName`, `lastName`, `password`) VALUES ('$userName','$email','$firstName','$lastName','$password')");
    header("location:login.php");
     }
   } 
 ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
 	<meta charset="UTF-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<link rel="stylesheet" href="css/navbar.css">
 	<link rel="stylesheet" href="css/signup.css">
 	<!-- CSS only -->
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
 		integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
 		crossorigin="anonymous">
 	<!-- JavaScript Bundle with Popper -->
 	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
 		integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
 		crossorigin="anonymous">
 	</script>
 	<!-- <script src="script/signup.js"></script> -->
 	<title>Sign Up</title>
 </head>

 <body>

 	<?php include 'partials/navbar.php';?>

 	<div class="left">
 		<div class="container">
 			<form action="signup.php" name="myForm" method="post">

 				<div class="log-center my-3">
 					<img src="icon/conversation.png" height="50px" width="50px"
 						alt=""><strong>Quora</strong>
 				</div>
 				<div class="log-center">
 					<span>Signup</span>
 				</div>
 				<div class="fullName">
 					<div class="form-group input1 ">
 						<div class="forgot" id="fname">
 							<label class="" for="exampleInputEmail1 p-2">FirstName</label>
 						</div>
 						<input type="text" class="form-control p-3 nameInput" id="firstname"
 							name="firstname" aria-describedby="emailHelp"
 							placeholder="firstname"
 							value="<?php echo $_POST['firstname'] ?? '' ?>">
 						<div class="error">
 							<?php echo $errors['firstname'] ?? ''; ?>
 						</div>
 					</div>

 					<div class="form-group input1 ">
 						<div class="forgot" id="fname">
 							<label class="" for="exampleInputEmail1 p-2">LastName</label>
 						</div>
 						<input type="text" class="form-control p-3 nameInput" id="lastName"
 							name="lastname" aria-describedby="emailHelp"
 							placeholder="lastname"
 							value="<?php echo $_POST['lastname'] ?? '' ?>">
 						<div class="error">
 							<?php echo $errors['lastname'] ?? ''; ?>
 						</div>
 					</div>

 				</div>


 				<div class="form-group input ">
 					<div class="forgot" id="fname">
 						<label class="" for="exampleInputEmail1 p-2">Username</label>
 						<label class="formerror"></label>
 					</div>

 					<input type="text" class="form-control p-3" id="userName" name="userName"
 						aria-describedby="emailHelp" placeholder="username"
 						value="<?php echo $_POST['userName'] ?? '' ?>">
 					<div class="error">
 						<?php echo $errors['userName'] ?? ''; ?>
 					</div>

 				</div>
 				<div class="form-group input ">
 					<div class="forgot" id="femail">
 						<label class="" for="exampleInputEmail1 p-2">Email</label>
 						<label class="formerror"></label>

 					</div>
 					<input type="text" class="form-control p-3" id="email" name="email"
 						aria-describedby="emailHelp" placeholder="Enter email"
 						value="<?php echo $_POST['email'] ?? '' ?>">
 					<div class="error">
 						<?php echo $errors['email'] ?? ''; ?>
 					</div>

 				</div>
 				<div class="form-group input">
 					<div class="forgot" id="fpass">
 						<label class="">Password</label>
 						<label class="formerror"></label>
 					</div>
 					<input type="password" class="form-control p-3" id="password" name="password"
 						placeholder="Password">
 					<div class="error">
 						<?php echo $errors['password'] ?? ''; ?>
 					</div>
 				</div>

 				<div class="form-group input">
 					<div class="forgot" id="fcpass">
 						<label class="" for="exampleInputEmail1 p-2">Confirm Password</label>
 						<label class="formerror"></label>
 					</div>
 					<input type="password" class="form-control p-3" id="cpassword" name="cpassword"
 						placeholder="Confirm Password">
 					<div class="error">
 						<?php echo $errors['cpassword'] ?? ''; ?>
 					</div>
 				</div>

 				<div class="button-bottom">
 					<button type="submit" name="submit"
 						class="btn btn-success mt-3">Signup</button>
 				</div>
 			</form>
 		</div>
 	</div>
 </body>

 </html>
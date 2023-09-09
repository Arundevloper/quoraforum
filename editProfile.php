<?php
    session_start();
    require 'include/db.connect.php';
    require 'include/Validation.php';
    $userNameit=$_SESSION['userName'];

    $data=new Users();
    $userData=$data->getTheData("SELECT * FROM `users_info` where userName='$userNameit'");
    foreach($userData as $data){
	  $firstNamei=$data['firstName'];
	  $lastNamei=$data['lastName'];
	  $userNamei=$data['userName'];
	  $emaili=$data['email_id'];	
	//   $phoneNumberi=$data['phno'];
	//   $professioni=$data['profession'];
	//   $dobi=$data['dob'];
    }


    if(isset($_POST['submit'])){//If the Sbumit button is set exexcute code below
	

	// variables for input data
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
        $userName = $_POST['userName'];
	$email = $_POST['email'];
	$phno=$_POST['phno'];
	$profession=$_POST['profession'];
	$dob=$_POST['dob'];
	
	$validation=new editProfile($_POST);//Passing all the posts value to UserValidation class

//     //validation for phone number

	// if(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{10}$/", $phno)) {
	// 	$validation->addError("phno","please enter valid phone number");
	// }

    //validation for dob
   
     //Creating object for checking username availvity
    $checkUsername=new CheckFields();
    $checkEmail=new CheckFields();
    if($userName==$userNamei){
	$userNameResult=0;
    }
    else{
    $userNameResult=$checkUsername->check("SELECT * FROM `users_info` where `userName`='$userName'");
    }
    if($email==$emaili){
	$emailResult=0;
    }
    else
    {
	    $emailResult=$checkEmail->check("SELECT * FROM `users_info` where `email_id`='$email'");
    }

    //Creating object of validation class for validating the form

   if(isset($phno)){

    if(preg_match('/^[0-9]{10}+$/', $phno)) {
	$phoneNumber=$phno;
      }
      else{
	$validation->addError("phno","Phone number is invalid");
      }
}





    //Passing the value to addError function because userName already exists
    if($userNameResult>0){
	$validation->addError("userName","username already exists");
    }
    //Passing the value to addError function because email already exists
    if($emailResult>0){
	$validation->addError("email","email already exists");
    }
    $errors=$validation->validateForm();

        $firstNamei = $_POST['firstname'];
	$lastNamei = $_POST['lastname'];
        $userNamei = $_POST['userName'];
	$emaili = $_POST['email'];

     //If no error insert data to db
     if($errors==null){
       
     //Saving the data to database

    $_SESSION['Sign_Success']="true";
    $insertData=new InsertData();
    $result= $insertData->query("UPDATE `users_info` SET `userName` = '$userName', `email_id` = '$email', `firstName` = '$firstName', `lastName` = '$lastName', `CurrentJob` = '$profession', `phno` = '$phoneNumber' WHERE `users_info`.`userName` = '$userName';");
    //header("location:profile.php");
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
	<title>profile-edit</title>
</head>

<body>

	<?php include 'partials/navbar.php';?>

	<div class="left">
		<div class="container">
			<form action="editProfile.php" name="myForm" method="post">
				<div class="log-center">
					<span>Edit Profile</span>
				</div>
				<div class="fullName">
					<div class="form-group input1 ">
						<div class="forgot" id="fname">
							<label class="" for="exampleInputEmail1 p-2">FirstName</label>
						</div>
						<input type="text" class="form-control p-3 nameInput" id="firstname"
							name="firstname" aria-describedby="emailHelp"
							placeholder="firstname" value="<?php echo  $firstNamei; ?>">
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
							placeholder="lastname" value="<?php echo  $lastNamei; ?>">
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
						value="<?php echo $userNamei ;?>">
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
						value="<?php echo $emaili ;?>">
					<div class="error">
						<?php echo $errors['email'] ?? ''; ?>
					</div>

				</div>


				<div class="form-group input ">
					<div class="forgot" id="phno">
						<label class="" for="exampleInputEmail1 p-2">Phone no.</label>
						<label class="formerror"></label>

					</div>
					<input type="number" class="form-control p-3" id="phono" name="phno"
						aria-describedby="emailHelp" placeholder="Enter Phone Number"
						value="<?php echo $phno ;?>">
					<div class="error">
						<?php echo $errors['phno'] ?? ''; ?>
					</div>

				</div>

				<div class="form-group input ">
					<div class="forgot" id="profession">
						<label class="" for="exampleInputEmail1 p-2">Profession</label>
						<label class="formerror"></label>

					</div>
					<input type="text" class="form-control p-3" id="profession" name="profession"
						aria-describedby="emailHelp" placeholder="Enter Profession"
						value="<?php //echo $profession ;?>">
					<div class="error">
						<?php echo $errors['profession'] ?? ''; ?>
					</div>

		

			
				
				<div class="button-bottom">
					<button type="submit" name="submit" class="btn btn-success mt-3">Update</button>
				</div>
			</form>
		</div>
	</div>
</body>

</html>
<?php 
     session_start();
     if(!isset($_SESSION['userName']) && $_SESSION['login']=true){
	$_SESSION["notLogin"]=true;
	header("location:login.php");
     }

     include 'include/db.connect.php';
     include 'include/Validation.php';

?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="css/navbar.css"> -->
	<link rel="stylesheet" href="css/Quora.css">
	<link rel="stylesheet" href="css/navbar.css">
	<script src="script/jquery.js"></script>
	<script src="script/quora.js"></script>
	<title>Quora</title>
	</head>

<body>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<?php 
    include 'partials/navbar.php';
    include 'partials/Modal.php';
    
    ?>

	<div class="main">

		<!-- Container to asks Questions  -->
		<div class="container my-3 ask-questions lol" data-toggle="modal" data-target="#exampleModal"">
            <div class=" user-container">
			<?php echo '<img class="profile-pic "  data-toggle="dropdown"  src="data:image/png;base64,'.base64_encode($userImage).'" alt="">';?>
			<p class="user-name-ques"> <strong><?php echo $userName;?></strong></p>
		</div>
		<div class="question">
			<h4 class="text-center">Click here! To add a Questions</h4>
		</div>
		<div class="error text-center">
			<?php echo $errors['exceed'] ?? ''; ?>
		</div>
		<div class="error text-center">
			<?php echo $errors['question'] ?? ''; ?>
		</div>
		<div class="error text-center">
			<?php echo $errors['questExist'] ?? ''; ?>
		</div>
		<div class="error text-center">
			<?php echo $errors['question-added'] ?? ''; ?>
		</div>
	</div>


	<div class="container my3 question-editor" style="display:none">
		<div class="rules">
			<h4>Tips on getting good answers quickly</h4>
			<ul class"modal-class-question">
				<li>Make sure your question has not been asked already</li>
				<li>Keep your question short and to the point</li>
				<li>Double-check grammar and spelling</li>
			</ul>
		</div>
		<form name="Modal-form" method="post">
			<div class="question-input-box">
				<textarea type="text" name="question" class="form-control"
					placeholder="Write Your Questions here. Limit 120 Characters"
					aria-label="Username" aria-describedby="addon-wrapping"></textarea>
			</div>
			<div class="modal-footer">
				<button type="submit" name="modal-question"  class="btn btn-success">Add
					question</button>
				
				<button type="button" class="btn btn-danger" id="modalClose" data-dismiss="modal">Close</button>
				
			</div>
		</form>
		
	</div>
<script>

	$('.lol').click(function(){
		$('.question-editor').show();

	});

	$('#modalClose').click(function(){
		$('.question-editor').hide();
	});
</script>


	<!-- <div class="container my-3">
		<div class="user-container">
			<img src="img/arunlal.jpg" class="user-img" alt="">
			<p class="user-college">From IIT Kharagpur</p>
			<p class="user-name"><strong>Arun Sharma</strong></p>
			<p class="user-date">7 january 2019</p>
		</div>
		<div class="user-post">
			<p class="my-2"> <a href="answerthread.php"> <strong>What is Python?</strong></a></p>
			<pre>

                </pre>
			<img src="img/python.jpg" alt="">
		</div>
	</div>


	<div class="container my-3">
		<div class="user-container">
			<img src="img/arunlal.jpg" class="user-img" alt="">
			<p class="user-college">From IIT Kharagpur</p>
			<p class="user-name"><strong>Arun Sharma</strong></p>
			<p class="user-date">7 january 2019</p>
		</div>
		<div class="user-post">
			<p class="my-2"><strong>What is Python?</strong></p>
			<p>Python is an interpreted high-level general-purpose programming language. Python's design
				philosophy
				emphasizes code readability with its notable use of significant indentation.<a
					href="#">more</a></p>
			<img src="img/arunlal.jpg" alt="">
		</div>
		<div class="user-likes my-2">
		</div>
	</div>
	</div> -->

</body>

</html>
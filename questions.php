<?php
session_start();
//if  user is not login
if (!isset($_SESSION['userName']) && $_SESSION['login'] = true) {
	$_SESSION["notLogin"] = true;
	header("location:login.php");
}

require 'include/db.connect.php';
require 'include/Validation.php';
require 'include/pagination.php';
$userName = $_SESSION['userName'];


// //Default code for pagination
$data = new Pagination("SELECT  questions.ques_Id,questions.question,questions.post,questions.userName,users_info.userImage from  questions JOIN users_info on questions.userName=users_info.userName order by questions.post Desc", 5, 0);
$questionSet = $data->get(0);
$pageNumber = $data->pageNumber("SELECT * FROM `questions`");

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['pagebutton'])) {
	$value = htmlspecialchars($_REQUEST['pagebutton']);

	// //Setting the limit and offset to retrive required data
	$offset = $value * 5;

	$data = new Pagination("SELECT  questions.ques_Id,questions.question,questions.post,questions.userName,users_info.userImage from  questions JOIN users_info on questions.userName=users_info.userName order by questions.post Desc", 5, $offset);
	$questionSet = $data->get();
	$pageNumber = $data->pageNumber("SELECT * FROM `questions`");
}





//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET['question-click'])) {
	$questionId = $_GET['question-click'];
	$_SESSION['questionId'] = $questionId;
	header("location:answer.editor.php");
}
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET['answer-click'])) {

	$questionId = $_GET['answer-click'];
	$_SESSION['ques_id'] = $questionId;
	header("location:answer.php");
}
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
		crossorigin="anonymous">
	<link rel="stylesheet" href="css/questions.css">
	<link rel="stylesheet" href="css/navbar.css">
	<script src="script/jquery.js" type="text/javascript"></script>
	<title>Questions</title>
</head>

<body>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
		crossorigin="anonymous"></script>


	<?php include 'partials/navbar.php'; ?>
	<div class="conatiner center">
		<div class="btn-group my-2">
			<a href="questions.php" class="btn btn-primary active" id="questions"
				aria-current="page">Questions</a>
			<a href="questionAsked.php" class="btn btn-primary" id="questionAskedByYou">Asked By Me</a>
			<a href="questionAns.php" class="btn btn-primary" id="answerdByYou">Answerd By Me</a>
		</div>


		<?php
		//Retriving questions and displaying it
		// foreach($questionSet as $question){
		// echo '<div class="container questionDiv" name="question" type="submit">
		// <p>'.$question["question"].' Asked by'.$question["userName"].'<p>
		// </div>';
		// }
		?>

		<?php
		if (empty($questionSet)) {
			echo ('</table>');
			echo ('<p class="my-4 " style="color:red;margin-left:5px;"><strong>No one asked question</strong></p>');
		} else {
			foreach ($questionSet as $question) {
				if ($userName == $question['userName']) {
					$question['userName'] = "you";
			
				}
				//echo $question["ques_Id"];	
				$phpdate = strtotime($question['post']);
				$mysqldate = date('j  F, Y @ g:i a', $phpdate);
				$questionId  =$question['ques_Id'];
				$check = new CheckFields();
				$answerExist = $check->check("SELECT * FROM `answer` where `ques_id`='$questionId' and `userName`='$userName'");
				$answereddAny=$check->check("SELECT * From `answer` where `ques_id`=$questionId");
				echo '	
			<form method="GET" action="' . $_SERVER["PHP_SELF"] . '">
      			 <div class="d-flex  question-lists my-3">
     			<div class="conatiner image m-2">
       			 <img  src="data:image/png;base64,' . base64_encode($question["userImage"]) . '"  alt="">
     			 </div>
      			<div class="container question">
      			 <h3>' . $question['question'] . '</h3>
       			<div class="d-flex justify-content-between">
         		 <p>by ' . $question["userName"] . ' on ' . $mysqldate . '</p>
			  <div class="edit-btn d-flex justify-content-between">
			  <span id="span'.$questionId.'"><p><button type="submit"  id="view'.$questionId.'" name="answer-click" value="' . $question['ques_Id'] . '" class="btn  my-3 btn-primary">View</button></p></span>
			 <span id="span'.$questionId.'"> <p><button type="submit" id="questionButton'.$questionId.'"  name="question-click" value="' . $question['ques_Id'] . '" class="btn my-3  btn-success">Answer</button></p></span>
			</div>
        		</div>
      			</div>
    			</div>
			</form>
				
			';
			if ($answerExist == 1) {

				echo '
					<script>
					var element = document.getElementById("questionButton'.$questionId.'");
					element.disabled = true;
					$("span'.$questionId.'").click(function(){
  					 alert("You Already Answered");
 					});
					 </script>';
			        }
			if($answereddAny==0){
				echo 
				'	<script>
					var element = document.getElementById("view'.$questionId.'");
					element.disabled = true;
					$("span'.$questionId.'").click(function(){
  					 alert("No one answered this question");
 					});
					</script>
				';
			}
			}
		}
		
		?>
		
		<div class="btn-group me-2" role="group" aria-label="Second group">
			<button type="text" class="btn btn-secondary">page no.</button>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<?php

				//Displaying numbers of pages
				for ($i = 0; $i < $pageNumber; $i++) {
					echo '<button type="submit" name="pagebutton" id="pgBtn" value="' . $i . '"  class="btn btn-secondary">' . $i . '</button>';
				} ?>
			</form>
		</div>
	</div>



</body>

</html>
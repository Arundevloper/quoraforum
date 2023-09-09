<?php 
  session_start();
  include 'include/db.connect.php';
  include 'include/Validation.php';

//php script to save question to datbase
$questionId=$_SESSION['questionIdEdit'];
$getQuestion=new Users();
$question=$getQuestion->getTheData("select `question` from `questions` where `ques_id`=$questionId");
foreach($question as $question){
	$questionEdit=$question['question'];
	
}
echo $questionEdit;
//php script to save question to datbase
if(isset($_POST['modal-question'])){
	if(isset($_SESSION['userName']) && $_SESSION['login']=true){
      $userName=$_SESSION['userName'];
      $question=$_POST['question'];
      
      $validate=new ModalVal($_POST);

      //Validating the modal class
      $errors=$validate->validateForm();
      
      //if error array is null Saving the data into database
      if($errors==NULL){
      
      $result=$validate->addingQuestionMark($question);
      $questionWithMarks=$result;
      
      
      //Instanseiting function to insert data to datbase
      $insertQuestion=new InsertData();
      $result=$insertQuestion->query("UPDATE `questions` SET `question` = '$question' WHERE `questions`.`ques_Id` = $questionId;");
      //validating the modal question
	header("location:questionAsked.php");
      }
      }
      }

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Question Edit</title>
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">
</head>

<body>
	<?php include 'partials/navbar.php';
	?>

	<div class="container" style="margin-top: 100px; width: 700px !important;">
		
	<div class="container my3 question-editor">
		<div class="rules">
			<h4>Tips on getting good answers quickly</h4>
			<ul class"modal-class-question">
				<li>Make sure your question has not been asked already</li>
				<li>Keep your question short and to the point</li>
				<li>Double-check grammar and spelling</li>
			</ul>
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
		<form name="Modal-form" method="post">
			<div class="question-input-box">
				<textarea type="text" name="question" class="form-control"
					 placeholder="Write Your Questions here. Limit 120 Characters"
					aria-label="Username" aria-describedby="addon-wrapping"><?php echo $questionEdit ?></textarea>
			</div>

			<div class="modal-footer">
				<button type="submit" name="modal-question"  class="btn btn-success">Update
					question</button>
					</form>
				<a href="questionAsked.php"><button type="button" class="btn btn-danger" id="modalClose" data-dismiss="modal">Cancel</button></a>
				
			</div>
		
		
	</div>
	</div>
</body>

</html>
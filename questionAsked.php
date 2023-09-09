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

 $data=new Pagination("SELECT  questions.ques_Id,questions.question,questions.post,questions.userName,users_info.userImage from  questions JOIN users_info on questions.userName='$userName' and users_info.userName='$userName' order by questions.post Desc",5,0);
 $questionSet=$data->get();
 $pageNumber=$data->pageNumber("SELECT * from `questions` WHERE `userName`='$userName'");
 
  if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['pagebutton'])){

  $value = htmlspecialchars($_REQUEST['pagebutton']);

 // //Setting the limit and offset to retrive required data
  $offset=$value*5;

  $data=new Pagination("SELECT  questions.ques_Id,questions.question,questions.post,questions.userName,users_info.userImage from  questions JOIN users_info on questions.userName='$userName' and users_info.userName='$userName' order by questions.post Desc",5,$offset);
  $questionSet=$data->get();
  $pageNumber=$data->pageNumber("SELECT * from `questions` WHERE `userName`='$userName'");
  }


//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

if(isset($_GET['delete'])){
	$ques_id = $_GET['delete'];
	$delete=new InsertData();
	$result=$delete->query(" DELETE FROM `questions` WHERE `ques_id`=$ques_id;");
	header("location:questionAsked.php");
      }

      
      if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET['edit'])) {
	$questionId = $_GET['edit'];
	$_SESSION['questionIdEdit'] = $questionId;
	header("location:question.editor.php");
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
	<title>Questions</title>
</head>

<body>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
		crossorigin="anonymous"></script>


	<?php include 'partials/navbar.php'; ?>
	<div class="conatiner center">
		<div class="btn-group">
			<a href="questions.php" class="btn btn-primary " id="questions"
				aria-current="page">Questions</a>
			<a href="questionAsked.php" class="btn btn-primary active" id="questionAskedByYou">Asked By
				you</a>
			<a href="questionAns.php" class="btn btn-primary" id="answerdByYou">Answerd By you</a>
		</div>
		<?php
			if (empty($questionSet)) {
				echo('</table>');
				echo('<p class="my-4 " style="color:red;margin-left:5px;"><strong>You did not asked any question</strong></p>');
			     
			   }
			else{
			foreach ($questionSet as $question) {
				if($userName==$question['userName']){
					$question['userName']="you";
				}
				//echo $question["ques_Id"];	
				$phpdate = strtotime( $question['post'] );
			        $mysqldate = date( 'j  F, Y @ g:i a', $phpdate );		
				echo '	
			<form method="GET" action="'.$_SERVER["PHP_SELF"].'">
			<div class="d-flex  question-lists my-3">
			  <div class="conatiner image m-2">
			    <img src="data:image/png;base64,'.base64_encode($question["userImage"]).'" alt="">
			  </div>
			  <div class="container question">
			    <h3>'.$question['question'].'</h3>
			    <div class="d-flex justify-content-between">
			      <p> by '.$question["userName"].' on '.$mysqldate.'</p>
			      <div class="edit-btn d-flex justify-content-between">
			      <p><button type="submit" value="'.$question['ques_Id'].'"  name="edit"  class="btn  my-3 btn-warning edit">Edit</button></p>
			      <p><button type="button" id="'.$question["ques_Id"].'" name="delete"  class="btn my-3 btn-danger delete">Delete</button></p>
			    </div>
			    </div>
			  </div>
			</div>
			</form>';
			}
		        }
			?>
		<div class="btn-group me-2" role="group" aria-label="Second group">
			<button type="text" class="btn btn-secondary">page no.</button>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<?php
				 
					//Displaying numbers of pages
					for ($i = 0; $i < $pageNumber; $i++) {
			echo '<button type="submit" name="pagebutton" id="pgBtn" value="' . $i . '"  class="btn btn-secondary">'.$i.'</button>';
					} ?>
			</form>
		</div>
	</div>

	<script>
	deletes = document.getElementsByClassName('delete');
	Array.from(deletes).forEach((element) => {
		element.addEventListener("click", (e) => {
			console.log("edit ");
			sno = e.target.id;
			console.log(sno);
			if (confirm("Are you sure you want to delete this Question!")) {
				console.log("yes");
				window.location = `questionAsked.php?delete=${sno}`;
				// TODO: Create a form and use post request to submit a form
			} else {
				console.log("no");
			}
		})
	})
	</script>



</body>

</html>
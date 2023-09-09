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
$text=$_SESSION['searchText'];
echo $text;

 $data=new Pagination("SELECT * from questions WHERE match(question) against('$text')",6,0);
 $questionSet=$data->get();
 $pageNumber=$data->pageNumber("SELECT * from questions WHERE match(question) against('$text')");
 
  if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['pagebutton'])){

  $value = htmlspecialchars($_REQUEST['pagebutton']);

 // //Setting the limit and offset to retrive required data
  $offset=$value*6;

  $data=new Pagination("SELECT * from questions WHERE match(question) against('$text')",6,$offset);
  $questionSet=$data->get();
  $pageNumber=$data->pageNumber("SELECT * from questions WHERE match(question) against('$text')");
  }


//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET['answer-click'])) {

	$questionId = $_GET['answer-click'];
	$_SESSION['ques_id'] = $questionId;
	header("location:answer.php");
}
?>

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
	<title>Serach Results</title>
</head>

<body>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
		crossorigin="anonymous"></script>


	<?php include 'partials/navbar.php'; ?>
	<div class="conatiner center">
	<h1>Search Results</h1>
		<?php
			if (empty($questionSet)) {
				echo('</table>');
				echo('<p class="my-4 " style="color:red;margin-left:5px;"><strong>No result found. Please add questions</strong></p>');
			     
			   }
			else{
			foreach ($questionSet as $question) {
				$questionId=$question['ques_Id'];
				//echo $question["ques_Id"];	
				$phpdate = strtotime( $question['post'] );
			        $mysqldate = date( 'j  F, Y @ g:i a', $phpdate );	
				
				$check= new CheckFields();
				$checkExist=$check->check("SELECT * from `answer` where `ques_id`='$questionId'");
				if($checkExist>0){
				echo '	
			<form method="GET" action="'.$_SERVER["PHP_SELF"].'">
			<div class="d-flex  question-lists my-3">
			  <div class="container question">
			    <h3>'.$question['question'].'</h3>
			    <div class="d-flex justify-content-between">
			      <p> by '.$question["userName"].' on '.$mysqldate.'</p>
			      <div class="edit-btn d-flex justify-content-between">
			      <p><button type="submit"  id="view'.$questionId.'" name="answer-click" value="' . $question['ques_Id'] . '" class="btn  my-3 btn-primary">View</button></p>
			    </div>
			    </div>
			  </div>
			</div>
			</form>';
			}
			else{
				echo('<p class="my-4 " style="color:red;margin-left:5px;"><strong>No result found or No one answer this question. Please add questions</strong></p>');
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
			echo '<button type="submit" name="pagebutton" id="pgBtn" value="' . $i . '"  class="btn btn-secondary">'.$i.'</button>';
					} ?>
			</form>
		</div>
	</div>

	

</body>

</html>
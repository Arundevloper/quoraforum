<?php
include '../include/db.connect.php';

// $type = $_POST['type'];
// $like_id = $_POST['like_id'];
// $answerId = $_POST['ans_id'];
// $questionId =$_POST['ques_id'];
// $userName = $_POST['userName'];

$type = "dislike";
$like_id = "like_94";
$answerId = 94;
$questionId =202;
$userName = "selena";


switch ($type) {
	case "like":
		$checkSql="select * from `likes` where `ans_id`='$answerId' and `ques_id`='$questionId' and `liked_userName`= '$userName'";
		$insertSql="INSERT INTO `likes` (`likeId`, `ques_id`, `ans_id`, `liked_userName`) VALUES (NULL, '$questionId', '$answerId', '$userName');";
		$deleteSql="DELETE FROM `dislikes` WHERE `ques_id`='$questionId' and `ans_id`='$answerId' and `dislike_userName`='$userName'";
		$count="select * from `likes` where `ans_id`='$answerId'";
		break;
	case "dislike":
		$checkSql="select * from `dislikes` where `ans_id`='$answerId' and `ques_id`='$questionId' and `dislike_userName`= '$userName'";
		$insertSql="INSERT INTO `dislikes` (`dislike_id`, `ques_id`, `ans_id`, `dislike_userName`) VALUES (NULL, '$questionId', '$answerId', '$userName');";
		$deleteSql="DELETE FROM `likes` WHERE `ques_id`='$questionId' and `ans_id`='$answerId' and `liked_userName`='$userName'";
		$count="select * from `dislikes` where `ans_id`='$answerId'";
		break;


	case "clike":
		$checkSql="select * from `likes` where `ans_id`='$answerId' and `ques_id`='$questionId' and `liked_userName`= '$userName'";
		$insertSql="INSERT INTO `likes` (`likeId`, `ques_id`, `ans_id`, `liked_userName`) VALUES (NULL, '$questionId', '$answerId', '$userName');";
		$deleteSql="DELETE FROM `dislikes` WHERE `ques_id`='$questionId' and `ans_id`='$answerId' and `dislike_userName`='$userName'";
		$count="select * from `likes` where `ans_id`='$answerId'";
		break;
	case "cdislike":
		$checkSql="select * from `dislikes` where `ans_id`='$answerId' and `ques_id`='$questionId' and `dislike_userName`= '$userName'";
		$insertSql="INSERT INTO `dislikes` (`dislike_id`, `ques_id`, `ans_id`, `dislike_userName`) VALUES (NULL, '$questionId', '$answerId', '$userName');";
		$deleteSql="DELETE FROM `likes` WHERE `ques_id`='$questionId' and `ans_id`='$answerId' and `liked_userName`='$userName'";
		$count="select * from `dislikes` where `ans_id`='$answerId'";
		break;


	case "rlike":
		$checkSql="select * from `likes` where `ans_id`='$answerId' and `ques_id`='$questionId' and `liked_userName`= '$userName'";
		$insertSql="INSERT INTO `likes` (`likeId`, `ques_id`, `ans_id`, `liked_userName`) VALUES (NULL, '$questionId', '$answerId', '$userName');";
		$deleteSql="DELETE FROM `dislikes` WHERE `ques_id`='$questionId' and `ans_id`='$answerId' and `dislike_userName`='$userName'";
		$count="select * from `likes` where `ans_id`='$answerId'";
		break;
	case "rdislike":
		$checkSql="select * from `dislikes` where `ans_id`='$answerId' and `ques_id`='$questionId' and `dislike_userName`= '$userName'";
		$insertSql="INSERT INTO `dislikes` (`dislike_id`, `ques_id`, `ans_id`, `dislike_userName`) VALUES (NULL, '$questionId', '$answerId', '$userName');";
		$deleteSql="DELETE FROM `likes` WHERE `ques_id`='$questionId' and `ans_id`='$answerId' and `liked_userName`='$userName'";
		$count="select * from `dislikes` where `ans_id`='$answerId'";
		break;	

}

$check = new CheckFields();
$perform=new InsertData();
$get=new Users();


$checkFunction= $check->check("$checkSql");
if ($checkFunction > 0) {

	$delete=$perform->query("$deleteSql");
}
else{
        $insert=$perform->query("$insertSql");
}

//Outputing the count of likes and dislikes
$Set=$get->getTheData("$count");
$SetDis=$get->getTheData("select * from `dislikes` where `ans_id`='$answerId'");
echo "dislikes". count($SetDis)."<br>";
echo "likes". count($Set);




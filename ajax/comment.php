<?php
include '../include/db.connect.php' ;



$type=$_POST['type'];
$answerId=$_POST['ans_id'];
$userName=$_POST['userName'];
$comment=$_POST['commentText'];

$getData=new Users();


if($type=="comment")
{
 $count=new CheckFields();
 $commentsNumber=$count->check("SELECT * FROM `comments` where `ans_id`=$answerId");	
 $submit= new InsertData();
 $result=$submit->query("INSERT INTO `comments` (`c_Id`, `ans_Id`, `userName`, `comment`) VALUES (NULL, '$answerId', '$userName', '$comment')");
 $retriveFields=$getData->getTheData("SELECT u.userImage,c.c_id,c.comment,c.dateTime,c.userName,c.dateTime from comments c join users_info u on u.userName=c.userName where c.ans_id='$answerId' order by c.dateTime desc limit 1");	
 foreach($retriveFields as $fields){
	$phpdate = strtotime( $fields['dateTime'] );
	$mysqldate = date( 'j  F, Y @ g:i a', $phpdate );
            echo '<div class="user-container">
	    <img class="profile-pic lol user_img"  data-toggle="dropdown"  src="data:image/png;base64,'.base64_encode($fields["userImage"]).'" alt="">
	    <p class="user-college" style="color:#5A79A5;font-weight:bold;"><a href="like">like</a> (12) <a href="">dislike</a> (1) <a href="">reply</a></p>
	    <p class="user-name"><strong>'.$fields["userName"].'</strong></p>
	    <p class="user-date" style="color:#5A79A5;font-weight:bold;">'.$mysqldate.'</p>
   	     </div>
   	    <pre class="my-3 pre">'.$fields['comment'].'</pre>
	   <a><p class="text-center" style="text-decoration:underline;cursor:pointer;color:rgb(52, 124, 219);">Load More Comments('.$commentsNumber.')</p></a>';
 }
}
	
















// $limit =1;
// 	$offset=1;
// 	 $retriveFields=$getData->getTheData("SELECT u.userImage,c.c_id,c.comment,c.dateTime,c.userName,c.dateTime from comments c join users_info u on u.userName=c.userName where c.ans_id='$answerId' order by c.dateTime desc");
// 	 foreach($retriveFields as $retriveFields){
// 		$commentFields= $retriveFields;
// 	}
// 	if(!empty($commentFields)){
// 		 echo $commentFields;
// 	 }	   

// }
?>



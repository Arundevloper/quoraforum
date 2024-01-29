<?php
include '../include/db.connect.php' ;

$type=$_POST['type'];
$answerId=$_POST['ans_id'];
$userName=$_POST['userName'];
$comment=$_POST['commentText'];

$getData=new Users();

if($type=="comment")
{
 $submit= new InsertData();
 $result=$submit->query("INSERT INTO `comments` (`c_Id`, `ans_Id`, `userName`, `comment`) VALUES (NULL, '$answerId', '$userName', '$comment')");
 $retriveFields=$getData->getTheData("SELECT u.userImage,c.c_id,c.comment,c.dateTime,c.userName,c.dateTime from comments c join users_info u on u.userName=c.userName where c.ans_id='$answerId' order by c.dateTime desc limit 1");	
 foreach($retriveFields as $fields){
	$phpdate = strtotime( $fields['dateTime'] );
	$mysqldate = date( 'j  F, Y @ g:i a', $phpdate );
            echo '<div class="user-container" id="commentboxes">
	    <img class="profile-pic lol user_img"  data-toggle="dropdown"  src="data:image/png;base64,'.base64_encode($fields["userImage"]).'" alt="">
	    <p class="user-college" style="color:#5A79A5;font-weight:bold;"><a href="like">like</a> (12) <a href="">dislike</a> (1)</p>
	    <p class="user-name"><strong>'.$fields["userName"].'</strong></p>
	    <p class="user-date" style="color:#5A79A5;font-weight:bold;">'.$mysqldate.'</p>
   	     </div>
   	    <pre class="my-3 pre"  style="margin-left:40px!important;">'.$fields['comment'].'</pre>
	       </div>
	  ';
 }
}

?>

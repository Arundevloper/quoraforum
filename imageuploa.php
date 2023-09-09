<?php
include 'include/db.connect.php';


if(isset($_POST['upload'])){
	echo "ho gya bhai";
	$image = $_FILES['image']['tmp_name']; 
	$imgContent = addslashes(file_get_contents($image)); 
     


	$save = new InsertData();
	$imageUpload = $save->query("INSERT INTO `upload` (`image`) VALUES('$imgContent')");
	if(!$imageUpload){
		echo "not Uploaded";
		
	}
	$images=new Users();
	$result=$images->getTheData("select * from `upload`");

	foreach($result as $result){
		echo '<img src="data:image/png;base64,'.base64_encode($result['image']).'" alt="">';
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Image Upload</title>
</head>

<body>
	<form action="imageuploa.php" method="post" name="imageUpload" enctype="multipart/form-data">
	<div class="form-group my-3">
		<div class="image-upload my-4 text-center">
			<label class="form-label" for="customFile">Upload Image</label>
			<input type="file" class="form-control" name="image" accept="image/x-png,image/gif,image/jpeg" id="customFile" />

		</div>
	</div>
	<button type="submit" name="upload">submit</button>
	</form>


</body>

</html>
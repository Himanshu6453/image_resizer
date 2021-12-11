<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>image resizer</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
                <input type="number" placeholder="Enter new width in px" name="widt" required>
        <input type="number" placeholder="Enter new hight in px" name="heig" required>

        <input type="submit" name="submit"/>
    </form>
    
</body>
</html>


<?php
if(isset($_POST['submit'])){
	//header('Content-Type:image/jpeg');
	//$file="sample.jpg";
	$file=$_FILES['file']['tmp_name'];
	list($width,$height)=getimagesize($file);
	$nwidth=$_POST['widt'];
	$nheight=$_POST['heig'];
	$newimage=imagecreatetruecolor($nwidth,$nheight);
	if($_FILES['file']['type']=='image/jpeg'){
		$source=imagecreatefromjpeg($file);
		imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
		$file_name=time().'.jpg';
		imagejpeg($newimage,'upload/'.$file_name);
	?>	<a href="upload/<?php echo $file_name;?>" download>Click here to download your picture<?php
	}elseif($_FILES['file']['type']=='image/png'){
		$source=imagecreatefrompng($file);
		imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
		$file_name=time().'.png';
		imagepng($newimage,'upload/'.$file_name);
			?>	<a href="upload/<?php echo $file_name;?>" download>Click here to download your picture<?php
	}elseif($_FILES['file']['type']=='image/gif'){
		$source=imagecreatefromgif($file);
		imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
		$file_name=time().'.gif';
		imagegif($newimage,'upload/'.$file_name);
			?>	<a href="upload/<?php echo $file_name;?>" download>Click here to download your picture<?php
	}else{
		echo "Please select only jpg, png and gif image";
	}
}
?>

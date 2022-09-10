<?php
session_start();
include("header.php");
if(isset($_POST[submit]))
{
	$filename =  rand() . $_FILES["photo"]["name"];
	move_uploaded_file($_FILES["photo"]["tmp_name"],"imgphoto/".$filename);
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE photo set album_id=$_POST[album_id],photo_title=$_POST[photo_title],photo_description=$_POST[photo_description],status=$_POST[status]";
		if($_FILES["photo"]["name"] != "")
		{
			$sql = $sql . " ,photo=$filename";
		}
		$sql = $sql . "	WHERE photo_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert( Photo record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	else
	{
	$sql ="INSERT INTO photo(album_id,photo_title,photo_description,status,photo) VALUES($_POST[album_id],$_POST[photo_title],$_POST[photo_description],$_POST[status],$filename)";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(photo record inserted successfully..);</script>";
		echo "<script>window.location=photo.php;</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
	}
}
?>
<?php
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM photo WHERE photo_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>


<div id="page-header">

<div class="section-bg" style="background-image: url(img/background-2.jpg);"></div>


<div class="container">
<div class="row">
<div class="col-md-12">
<div class="header-content">
<h1>Photo</h1>
</div>
</div>
</div>
</div>

</div>

</header>


<div class="section" style="padding-top: 1px;">

<div class="container">

<div class="row">

<main id="" class="col-md-12">

<div class="">



<div class="">


<div class="article-comments">

<div class="media">
<div class="media-left">
<img class="media-object" src="img/charity.jpg"  style="width: 100px;height: 100px;">
</div>
<div class="media-body">
	<div class="media-heading">
	<h4>Photo</h4>
	</div>
	<p>
<form method="post" action="" enctype="multipart/form-data" onsubmit="return validateform()">

<div class="row">
		<div class="col-md-2" style="padding-top: 5px;"> Album</div>
		<div class="col-md-10">
			<select id="album_id" name="album_id" class="form-control">               
	<option value="">Select album</option>
	<?php
	$sqlalbum = "SELECT * FROM album WHERE status=Active";
	$qsqlalbum = mysqli_query($con,$sqlalbum);
	while($rsalbum = mysqli_fetch_array($qsqlalbum))
	{
		if($rsalbum[album_id] == $rsedit[album_id])
		{
	echo "<option value=$rsalbum[album_id] selected>$rsalbum[album_title]</option>";	
		}
		else
		{
	echo "<option value=$rsalbum[album_id]>$rsalbum[album_title]</option>";	
		}
	}
	?>
			</select>
	<span id="erralbum_id" class="errorclass"></span>
		</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Photo Title </div>
	<div class="col-md-10">
		<input type="text" name="photo_title" id="photo_title" class="form-control" value="<?php echo $rsedit[photo_title]; ?>">
		<span id="errphoto_title" class="errorclass"></span>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Photo  </div>
	<div class="col-md-10">
		<input type="file" name="photo" id="photo" class="form-control" accept="image/*" >
		<?php
		if(isset($_GET[editid]))
		{
			echo "<img src=imgphoto/$rsedit[photo] style=width: 360px; height: 300px;>";
		}
		?>
		<span id="errphoto" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Photo Description  </div>
	<div class="col-md-10">
		<textarea name="photo_description" id="photo_description" class="form-control"><?php echo $rsedit[photo_description]; ?></textarea>
		<span id="errphoto_description" class="errorclass"></span>
	</div>
</div>
<span id="errphoto_description" class="errorclass"></span>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Status</div>
	<div class="col-md-10">
		<select class="form-control" name="status" id="status">
			<option value="">Select Status</option>
			<?php
			$arr = array("Active","Inactive");
			foreach($arr as $val )
			{
				if($val == $rsedit[status]){echo "<option value=$val selected>$val</option>";} else {echo "<option value=$val>$val</option>";}
			}
			?>
		</select>
		<span id="errstatus" class="errorclass"></span>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"></div>
	<div class="col-md-10">
		<input type="submit" name="submit" id="submit" class="form-control btn btn-success" style="width: 200px;">
	</div>
</div>
</form>
	</p>
	</div>
</div>


</div>


</div>

</main>

</div>

</div>

</div>
<?php
include("footer.php");
?>
<?php
if(isset($_GET[editid]))
{
?>
<script>
function validateform()
{
	var i = 0;	
	$(.errorclass).html();
	
	if(document.getElementById("album_id").value=="")
	{
		document.getElementById("erralbum_id").innerHTML = "Kindly select  album...";
		i = 1;
	}
	if(document.getElementById("photo_title").value=="")
	{
		document.getElementById("errphoto_title").innerHTML = "Kindly enter Photo title....";
		i = 1;
	}
	if(document.getElementById("photo_description").value=="")
	{
		document.getElementById("errphoto_description").innerHTML = "Photo description should not be empty...";
		i = 1;
	}
	if(document.getElementById("status").value=="")
	{
		document.getElementById("errstatus").innerHTML = "Kindly select status...";
		i = 1;
	}
	
	if(i == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}
</script>
<?php
}
else
{
?>
<script>
function validateform()
{
	var i = 0;	
	$(.errorclass).html();
	
	if(document.getElementById("album_id").value=="")
	{
		document.getElementById("erralbum_id").innerHTML = "Kindly select  album...";
		i = 1;
	}
	if(document.getElementById("photo_title").value=="")
	{
		document.getElementById("errphoto_title").innerHTML = "Kindly enter Photo title....";
		i = 1;
	}
	
	if(document.getElementById("photo").value=="")
	{
		document.getElementById("errphoto").innerHTML = "Kindly upload the photo....";
		i = 1;
	}
	if(document.getElementById("photo_description").value=="")
	{
		document.getElementById("errphoto_description").innerHTML = "Photo description should not be empty...";
		i = 1;
	}
	if(document.getElementById("status").value=="")
	{
		document.getElementById("errstatus").innerHTML = "Kindly select status...";
		i = 1;
	}
	
	if(i == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}

</script>
<?php
}
?>
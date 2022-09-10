<?php
session_start();
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE album set album_title=$_POST[album_title],album_description=$_POST[album_description],status=$_POST[status] WHERE album_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Album record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	else
	{
		$sql ="INSERT INTO album(album_title,album_description,status) VALUES($_POST[album_title],$_POST[album_description],$_POST[status])";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Album record inserted successfully..);</script>";
			echo "<script>window.location=album.php;</script>";
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
	$sqledit = "SELECT * FROM album WHERE album_id=$_GET[editid]";
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
<h1>Album</h1>
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
	<h4>Album</h4>
	</div>
	<p>
<form method="post" action=""  onsubmit="return validateform()">
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Album Title</div>
	<div class="col-md-10"> 
	<input type="text" name="album_title"  id="album_title" class="form-control"value="<?php echo $rsedit[album_title]; ?>" >
	<span id="erralbum_title" class="errorclass"></span>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Album Description</div>
	<div class="col-md-10">
	<textarea name="album_description" id="album_description" class="form-control"><?php echo $rsedit[album_description]; ?></textarea>
	<span id="erralbum_description" class="errorclass"></span>
	</div>
</div>

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
<script>
function validateform()
{
	var i = 0;	
	$(.errorclass).html();
	if(document.getElementById("album_title").value == "")
	{
		document.getElementById("erralbum_title").innerHTML = "Album title should not be empty..";
		i=1;
	}
	/*
	if(document.getElementById("album_description").value == "")
	{
		document.getElementById("erralbum_description").innerHTML = "Staff Name should not be empty..";
		i=1;
	}
	*/
	if(document.getElementById("status").value == "")
	{
		document.getElementById("errstatus").innerHTML = "Status should not be empty..";
		i=1;
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
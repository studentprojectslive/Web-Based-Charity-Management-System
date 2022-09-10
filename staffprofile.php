<?php
session_start();
?>
<?php
include("header.php");
if(isset($_POST[submit]))
{
		$sql ="UPDATE staff set staff_type=$_POST[staff_type],staff_name=$_POST[staff_name],login_id=$_POST[login_id]  WHERE staff_id=$_SESSION[staff_id]";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Staff record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
}
?>
<?php
if(isset($_SESSION[staff_id]))
{
	$sqledit = "SELECT * FROM staff WHERE staff_id=$_SESSION[staff_id]";
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
<h2>Staff Profile</h2>
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
	<h4>Staff Profile</h4>
	</div>
	<p>
<form method="post" action="" onsubmit="return validateform()">
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Staff Type </div>
	<div class="col-md-10">
		<input type="text" name="staff_type" id="staff_type" class="form-control" value="<?php	echo $rsedit[staff_type];	?>" readonly>
		<span id="errstaff_type" class="errorclass"></span>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Staff Name </div>
	<div class="col-md-10">
		<input type="text" name="staff_name" id="staff_name" class="form-control" value="<?php echo $rsedit[staff_name]; ?>">
	<span id="errstaff_name" class="errorclass"></span>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Login Id  </div>
	<div class="col-md-10">
		<input type="text" name="login_id"  id="login_id" class="form-control"value="<?php echo $rsedit[login_id]; ?>">
	<span id="errlogin_id" class="errorclass"></span>
	</div>
</div>


<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"></div>
	<div class="col-md-10">
		<input type="submit" name="submit" id="submit" value="Update Profile" class="form-control btn btn-success" style="width: 200px;">
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
	if(document.getElementById("staff_type").value == "")
	{
		document.getElementById("errstaff_type").innerHTML = "Kindly select Staff Type..";
		i=1;
	}
	if(document.getElementById("staff_name").value == "")
	{
		document.getElementById("errstaff_name").innerHTML = "Staff Name should not be empty..";
		i=1;
	}
	if(document.getElementById("login_id").value == "")
	{
		document.getElementById("errlogin_id").innerHTML = "Login ID should not be empty..";
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
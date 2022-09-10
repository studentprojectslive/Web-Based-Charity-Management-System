<?php
session_start();
?>
<?php
include("header.php");
if(isset($_POST[submit]))
{
	//opassword password
	$sql ="UPDATE staff SET password=$_POST[password] where staff_id=$_SESSION[staff_id] AND password=$_POST[opassword]";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Password updated successfully..);</script>";
		echo "<script>window.location=staffchangepassword.php;</script>";
	}
	else
	{
		echo "<script>alert(Failed to update successfully..);</script>";
	}
}
?>


<div id="page-header">

<div class="section-bg" style="background-image: url(img/background-2.jpg);"></div>


<div class="container">
<div class="row">
<div class="col-md-12">
<div class="header-content">
<h1>Staff - Change Password</h1>
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

	<p>
<form method="post" action="" enctype="multipart/form-data" onsubmit="return validateform()">

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Existing Password </div>
	<div class="col-md-10">
		<input type="password" name="opassword"  id="opassword" class="form-control">
<span id="erropassword" class="errorclass"></span>
	</div>
</div><br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Password </div>
	<div class="col-md-10">
		<input type="password" name="password"  id="password" class="form-control">
	<span id="errpassword" class="errorclass"></span>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Confirm Password </div>
	<div class="col-md-10">
		<input type="password" name="confirmpassword" id="confirmpassword" class="form-control"><span id="errconfirmpassword" class="errorclass"></span>
	</div>
</div><br>


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
	
	if(document.getElementById("opassword").value=="")
	{
		document.getElementById("erropassword").innerHTML = "Kindly enter the password ...";
		i = 1;
	}
	if(document.getElementById("password").value=="")
	{
		document.getElementById("errpassword").innerHTML = "Kindly enter the password ...";
		i = 1;
	}
		
	if(document.getElementById("confirmpassword").value=="")
	{
		document.getElementById("errconfirmpassword").innerHTML = "Kindly enter confirm password....";
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
<?php
session_start();
?>
<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE staff set staff_type=$_POST[staff_type],staff_name=$_POST[staff_name],login_id=$_POST[login_id],password=$_POST[password],status=$_POST[status]  WHERE staff_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(staff record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	else
	{
	$sql ="INSERT INTO staff(staff_type,staff_name,login_id,password,status) VALUES($_POST[staff_type] ,$_POST[staff_name] ,$_POST[login_id],$_POST[password],$_POST[status])";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(staff record inserted successfully..);</script>";
		echo "<script>window.location=staff.php;</script>";
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
	$sqledit = "SELECT * FROM staff WHERE staff_id=$_GET[editid]";
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
<h1>Staff</h1>
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
	<h4>Staff</h4>
	</div>
	<p>
<form method="post" action=""  onsubmit="return validateform()">
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Staff Type</div>
	<div class="col-md-10">
	<select class="form-control" name="staff_type" id="staff_type">
		<option value="">Select Staff Type</option>
		<?php
		$arr = array("Admin","Employee");
		foreach($arr as $val )
		{
			if($val == $rsedit[staff_type]){echo "<option value=$val selected>$val</option>";} else {echo "<option value=$val>$val</option>";}
		}
		?>
	</select>
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
	<div class="col-md-2" style="padding-top: 5px;"> Password </div>
	<div class="col-md-10">
		<input type="password" name="password"  id="password" class="form-control" value="<?php echo $rsedit[password]; ?>">
	<span id="errpassword" class="errorclass"></span>
	</div>
</div>


<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Confirm Password </div>
	<div class="col-md-10">
		<input type="password" name="confirmpassword" id="confirmpassword" class="form-control" value="<?php echo $rsedit[password]; ?>">
	<span id="errconfirmpassword" class="errorclass"></span>
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
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,6}$/;
	var mobno = /^[6-9]\d{9}$/;

	$(.errorclass).html();
		
//Validation code starts here
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
if(document.getElementById("password").value == "")
{
	document.getElementById("errpassword").innerHTML = "Password should not be empty..";
	i=1;
}
if(document.getElementById("confirmpassword").value == "")
{
	document.getElementById("errconfirmpassword").innerHTML = "Confirm Password should not be empty..";
	i=1;
}
if(document.getElementById("status").value == "")
{
	document.getElementById("errstatus").innerHTML = "Kindly select the status..";
	i=1;
}
//Validation code ends here
		
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
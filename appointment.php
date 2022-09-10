<?php
session_start();
?>
<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE appointment set appointment_title=$_POST[appointment_title],donor_id=$_POST[donor_id],staff_id=$_POST[staff_id],	reason_for_appoinment=$_POST[reason_for_appoinment],appointment_date=$_POST[appointment_date],appointment_time=$_POST[appointment_time],status=$_POST[status] WHERE appointment_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Appointment record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	else
	{
	$sql ="INSERT INTO appointment(appointment_title,donor_id,staff_id,	reason_for_appoinment, appointment_date ,appointment_time ,status) VALUES($_POST[appointment_title],$_SESSION[donor_id],$_POST[staff_id],$_POST[reason_for_appoinment],$_POST[appointment_date],$_POST[appointment_time],Pending)";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Appointment Entry done successfully..);</script>";
		echo "<script>window.location=viewappointment.php;</script>";
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
	$sqledit = "SELECT * FROM appointment WHERE appointment_id=$_GET[editid]";
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
<h1>Appoinment</h1>
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
	<h4>Visitor Appoinment Request Panel</h4>
	</div>
	<p>
<form method="post" action="" onsubmit="return validateform()">
<div class="row">
	<div class="col-md-3" style="padding-top: 5px;">Appointment For  </div>
	<div class="col-md-9">
		<input type="text" name="appointment_title"  id="appointment_title" class="form-control" value="<?php echo $rsedit[appointment_title]; ?>">
		<span id="errappointment_title" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 5px;"> Reason for Appointment </div>
	<div class="col-md-9">
		<textarea name="reason_for_appoinment"  id="reason_for_appoinment" class="form-control"><?php echo $rsedit[reason_for_appoinment]; ?></textarea>
		<span id="errreason_for_appoinment" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 5px;"> Appointment Date  </div>
	<div class="col-md-9">
		<input type="date" name="appointment_date" id="appointment_date" class="form-control" min="<?php echo  date("Y-m-d"); ?>" value="<?php echo $rsedit[appointment_date]; ?>">
		<span id="errappointment_date" class="errorclass"></span>
	</div>
</div>


<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 5px;"> Appointment Time </div>
	<div class="col-md-9">
		<input type="time" name="appointment_time" id="appointment_time" class="form-control" value="<?php echo $rsedit[appointment_time]; ?>">
		<span id="errappointment_time" class="errorclass"></span>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 5px;"></div>
	<div class="col-md-9">
		<input type="submit" name="submit" id="submit" value="Request for Appoinment" class="form-control btn btn-success" style="width: 200px;">
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
	if(document.getElementById("appointment_title").value == "")
	{
		document.getElementById("errappointment_title").innerHTML = "Food item detail should not be empty..";
		i=1;
	}
	if(document.getElementById("reason_for_appoinment").value == "")
	{
		document.getElementById("errreason_for_appoinment").innerHTML = "Quantity should not be empty..";
		i=1;
	}
	if(document.getElementById("appointment_date").value == "")
	{
		document.getElementById("errappointment_date").innerHTML = "Address should not be empty..";
		i=1;
	}
	if(document.getElementById("appointment_time").value == "")
	{
		document.getElementById("errappointment_time").innerHTML = "City should not be empty..";
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
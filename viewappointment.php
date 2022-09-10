<?php
session_start();
?>
<?php
include("header.php");
if(isset($_GET[st]))
{ 
	$sql = "UPDATE appointment SET status=$_GET[st] WHERE appointment_id=$_GET[id]";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Appointment $_GET[st] successfully..);</script>";
		echo "<script>window.location=viewappointment.php;</script>";
	}
}
?>
</header>
<div id="about" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="section-title">
			<center><h2 class="title">view appointment</h2></center>
			</div>
			</div>
		</div>
	</div>
</div>


<div id="numbers" class="section">

<div class="container">

<div class="row">

<div class="col-md-12 col-sm-12">
	<div class="number">

<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Donor</th>
			<th>Appointment title</th>
			<th>Appointment date time</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	$sql = "SELECT appointment.*, donor.name, donor.contact_no, donor.email_id, staff.staff_name FROM appointment LEFT JOIN donor on appointment.donor_id=donor.donor_id LEFT JOIN staff ON staff.staff_id=appointment.staff_id WHERE appointment.status != ";
	if(isset($_SESSION[donor_id]))
	{
		$sql = $sql . " AND appointment.donor_id=$_SESSION[donor_id]";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td style=text-align: left;>
			<b>$rs[name]</b>
			<br>
			Ph. No. $rs[contact_no]<br>
			Email $rs[email_id]
			</td>
			<td style=text-align: left;><b>$rs[appointment_title]</b><br>$rs[reason_for_appoinment]</td>
			<td style=text-align: left;><b>Date:</b> " . date("d-M-Y",strtotime($rs[appointment_date])) . "<br> <b>Time:</b> " . date("h:i A",strtotime($rs[appointment_time])) . "</td>
			<td>$rs[status]";		
		echo "</td>
			<td>";

if(isset($_SESSION[staff_id]))
{
		echo "<a href=viewappointment.php?id=$rs[0]&st=Approved class=btn btn-info  onclick=return confirmdel1() >Approve</a><hr>";
}
		echo "<a href=viewappointment.php?id=$rs[0]&st=Cancelled class=btn btn-danger onclick=return confirmdel2() >Cancel</a>";
			
		echo "</td></tr>";
	}
?>
	</tbody>
</table>

	</div>
</div>

</div>

</div>

</div>

<?php
include("footer.php");
?>
<script>
function confirmdel1()
{
	if(confirm("Are you sure want to Approve?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function confirmdel2()
{
	if(confirm("Are you sure want to Approve?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<?php
session_start();
include("header.php");
//food_donor_id st
if(isset($_GET[st]))
{
	$sqlupd = "UPDATE food_donor SET status=$_GET[st] WHERE  food_donor_id=$_GET[food_donor_id]";
	$qsqlupd = mysqli_query($con,$sqlupd);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Food donation request $_GET[st] ..);</script>";
		echo "<script>window.location=viewfooddonor.php;</script>";
	}
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM food_donor WHERE food_donor_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(food donor record deleted successfully..);</script>";
		echo "<script>window.location=viewfooddonor.php;</script>";
	}
}
?>
</header>
<div id="about" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="section-title">
			<center><h2 class="title">View Food Donor</h2></center>
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
			<th style="width: 135px;">Pickup Location</th>
			<th>Food Item Detail</th>
			<th>Pickup Date Time</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
			<?php
	$sql = "SELECT food_donor.*, donor.name, donor.email_id, donor.contact_no, staff.staff_name,staff.login_id FROM food_donor LEFT JOIN donor ON donor.donor_id=food_donor.donor_id LEFT JOIN staff oN staff.staff_id=food_donor.staff_id WHERE food_donor.status != Deleted ";
	if(isset($_SESSION[donor_id]))
	{
		$sql = $sql . " AND food_donor.donor_id=$_SESSION[donor_id] ";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td style=text-align: left;>
			$rs[name]<br>
			<b>Email:</b> $rs[email_id] <br>
			<b>Ph. No. :</b> $rs[contact_no]
			</td>
			<td style=text-align: left;>$rs[address]<br>$rs[city]<br> <b>PIN: </b>$rs[pin_code]</td>
			<td style=text-align: left;>$rs[food_item_detail]</td>
			<td style=text-align: left;>" . date("d-M-Y",strtotime($rs[datetime])) . "<br>".
					date("h:i A",strtotime($rs[datetime]))
			. "</td>
			<td>$rs[quantity]</td>
			<td><b>$rs[status]</b>";
			echo "</td>
			<td>";
		if($rs[status] == Pending)
		{
echo "<a href=viewfooddonor.php?delid=$rs[0] class=btn btn-danger onclick=return confirmdel() >Delete</a><br>";
		}
		if($rs[status] == Pending)
		{
if(isset($_SESSION[staff_id]))
{	
echo "<a href=viewfooddonor.php?food_donor_id=$rs[0]&st=Accepted  class=btn btn-success onclick=return confirmst() >Accept</a><br>";
echo "<a href=viewfooddonor.php?food_donor_id=$rs[0]&st=Rejected  class=btn btn-warning onclick=return confirmst() >Reject</a>";
}	
		}
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
function confirmdel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function confirmst()
{
	if(confirm("Are you sure?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
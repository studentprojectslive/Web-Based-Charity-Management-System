<?php
session_start();
?>
<?php
include("header.php");
if(!isset($_SESSION[staff_id]))
{
	echo "<script>window.location=index.php;</script>";
}
if(isset($_GET[delid]))
{
	$sqldel = "DELETE FROM staff where staff_id=$_GET[delid]";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert(Staff record deleted successfully..);</script>";
	echo "<script>window.location=viewstaff.php;</script>";	
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
</header>
<div id="about" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="section-title">
			<center><h2 class="title">View Staff</h2></center>
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
			<th>Staff Type </th>
			<th>Staff Name</th>
			<th>Login Id</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	$sql = "SELECT * FROM staff";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td style=text-align: left;>$rs[staff_type]</td>
			<td style=text-align: left;>$rs[staff_name]</td>
			<td style=text-align: left;>$rs[login_id]</td>
			<td style=text-align: left;>$rs[status]</td>
			<td style=text-align: left;>
			
			<a href=staff.php?editid=$rs[0]  class=btn btn-primary >Edit</a>

			| <a href=viewstaff.php?delid=$rs[0] class=btn btn-danger onclick=return confirmdel() >Delete</a></td>
			</tr>";
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
</script>
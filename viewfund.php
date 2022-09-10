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
	$sql = "DELETE FROM fund WHERE fund_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(fund record deleted successfully..);</script>";
		echo "<script>window.location=viewfund.php;</script>";
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
			<center><h2 class="title">View Fund</h2></center>
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
			<th>Banner</th>			
			<th>Title</th>			
			<th style=text-align: right;>Fund Amount</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
	$sql = "SELECT * FROM fund_raiser";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr><td style=text-align: left;>";
		
if($rs[banner_img] == "")
{
	echo "<img src=img/no-image-icon.png style=width: 100px;height: 100px; >";
}
else if(file_exists("imgfundraiser/".$rs[banner_img]))
{
	echo "<img src=imgfundraiser/".$rs[banner_img]. " style=width: 100px;height: 100px; >";
}
else
{
	echo "<img src=img/no-image-icon.png style=width: 100px;height: 100px; >";	
}
		
			echo "</td>
			<td style=text-align: left; width: 250px;>$rs[title]</td>
			<td style=text-align: right;>₹$rs[fund_amount]</td>
			<td>" . date("d-M-Y",strtotime($rs[start_date])) . " </td>
			<td>" . date("d-M-Y",strtotime($rs[end_date])) . " </td>
			<td>$rs[status]</td>
			<td>
			<a href=fund.php?editid=$rs[0]  class=btn btn-primary >Edit</a>
			
			<a href=viewfund.php?delid=$rs[0] class=btn btn-danger onclick=return confirmdel() >Delete</a>
			</td>
			
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
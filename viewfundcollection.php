<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM fund_collection WHERE fund_collection_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(fund collection record deleted successfully..);</script>";
		echo "<script>window.location=viewfundcollection.php;</script>";
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
			<center><h2 class="title">View Fund Collection</h2></center>
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
			<th>Fund Raiser detail</th>
			<th>Donor detail</th>
			<th>Paid  Date</th>
			<th>Payment Detail</th>
			<th style=text-align: right;>Paid Amount</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
	$sql = "SELECT * FROM fund_collection LEFT JOIN donor ON donor.donor_id=fund_collection.donor_id LEFT JOIN fund_raiser on fund_raiser.fund_raiser_id=fund_collection.fund_raiser_id where fund_collection.status=Active";
	if(isset($_SESSION[donor_id]))
	{
		$sql = $sql . " AND fund_collection.donor_id=$_SESSION[donor_id]";
	}
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td style=text-align: left;>";
			
		echo "<b>".$rs[title] . "</b><br>";
		echo "<b>Starts -</b> " . date("d-M-Y",strtotime($rs[start_date])) . "<br>";
		echo "<b>Ends -</b> " . date("d-M-Y",strtotime($rs[end_date])) . "<br>";
		
		echo "</td>	<td style=text-align: left;>";
		
		echo "<b>". $rs[name] . "</b><br>";
		echo $rs[address] . ",<br>". $rs[city] . "-". $rs[pin_code] . "<br><b>Ph No.</b>". $rs[contact_no] . "<br>";
		
		echo "</td>
			<td>" . date("d-M-Y",strtotime($rs[paid_date])) . "</td>
			<td style=text-align: left;>";
		$payment_detail =  unserialize($rs[payment_detail]);
		echo "<b>Payment Type -</b> " . $rs[payment_type] . "<br>";
		echo "<b>Card holder -</b> " .$payment_detail[0] . "<br>";
		echo "<b>Card Number -</b> " .$payment_detail[1] . "<br>";
		echo "<b>Expiry date -</b> " .$payment_detail[2] . "<br>";
		echo "</td>
			<th style=text-align: right;>₹$rs[paid_amt]</th>
			<td>
			<a href=fundcollectionreceipt.php?fund_collection_id=$rs[0]  class=btn btn-primary target=_blank >Print</a>
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
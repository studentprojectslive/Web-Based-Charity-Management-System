<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sqldel = "DELETE FROM staff where staff_id=$_GET[delid]";
	$qsqldel = mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert(Staff record deleted successfully..);</script>";
	echo "<script>window.location=viewstaff.php;</script>";	
	}
}
if(isset($_GET[fund_collection_id]))
{
	$sqlfund_collection = "SELECT * FROM  fund_collection WHERE fund_collection_id=$_GET[fund_collection_id]";
	$qsqlfund_collection = mysqli_query($con,$sqlfund_collection);
	$rsfund_collection = mysqli_fetch_array($qsqlfund_collection);
	$sqldonor  ="SELECT * FROM donor WHERE donor_id=$rsfund_collection[donor_id]";
	$qsqldonor =mysqli_query($con,$sqldonor);
	echo mysqli_error($con);
	$rsdonor = mysqli_fetch_array($qsqldonor);
	
	$sqlfund_raiser  ="SELECT * FROM fund_raiser WHERE fund_raiser_id=$rsfund_collection[fund_raiser_id]";
	$qsqlfund_raiser =mysqli_query($con,$sqlfund_raiser);
	echo mysqli_error($con);
	$rsfund_raiser = mysqli_fetch_array($qsqlfund_raiser);
}
?>
</header>
<div id="about" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="section-title">
			<center><h2 class="title">FUND COLLECTION RECEIPT</h2></center>
			</div>
			</div>
		</div>
	</div>
</div>


<div id="numbers" class="section">

<div class="container">

<div class="row" id="divprint">

<div class="col-md-12 col-sm-12">
	<div class="number">

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th colspan="2"><center><img src="img/logo.png"></center></th>
		</tr>
		<tr>
			<th colspan="2"><center><h4>FUND COLLECTION RECEIPT</h4></center></th>
		</tr>
		<tr>
			<td style="text-align: left;WIDTH: 50%;">
			<b>Donor :</b>
			<br>
			<?php echo $rsfund_collection[name]; ?>
			<?php echo $rsdonor[address]; ?><br>
			<?php echo $rsdonor[city]; ?><br>
			<B>PIN -</B> <?php echo $rsdonor[pin_code]; ?>
			</td>
			<td style="text-align: right;" valign="top">
				<b>Date : </b><?php echo date("d-M-Y",strtotime($rsfund_collection[paid_date])); ?><br>
				<b>Bill No. :</b><?php echo $rsfund_collection[0]; ?>
			</td>
		</tr>
	</thead>
</table>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th style="text-align: left;">
				<b>Donation Payment</b>
			</th>
			<th style="text-align: right;" valign="top">
				<b>Amount</b>
			</th>
		</tr>
		<tr>
			<th style="text-align: left;">
				<?php echo $rsfund_raiser[title]; ?><br>
				Collection from <?php echo date("d-M-Y",strtotime($rsfund_raiser[start_date])); ?> - <?php echo date("d-M-Y",strtotime($rsfund_raiser[end_date])); ?><br>
				<br>
				<b>Payment type: <?php echo $rsfund_collection[payment_type]; ?></b>
			</th>
			<th style="text-align: right;" valign="top">
				₹<?php echo $rsfund_collection[paid_amt]; ?>
			</th>
		</tr>
	</thead>
</table>
<hr>
</center>Thank you for your generosity. Thank you for your contribution.</center>

	</div>
</div>

</div>

<center><input type="button" class="btn btn-success" name="btnprint" value="Print" onclick="printreceipt()" ></center>
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
<script>
function printreceipt()
{
	var divName ="divprint";
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
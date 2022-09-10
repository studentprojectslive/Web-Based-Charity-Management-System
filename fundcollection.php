<?php
session_start();
?>
<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE fund_collection set fund_id=$_POST[fund_id],donor_id=$_POST[donor_id],paid_amt=$_POST[paid_amt],paid_date=$_POST[paid_date],payment_type=$_POST[payment_type],payment_detail=$_POST[payment_detail],status=$_POST[status] WHERE fund_collection_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(fund collection record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	else
	{
	$sql ="INSERT INTO fund_collection(fund_id,donor_id,paid_amt,payment_type,payment_detail,status) VALUES($_POST[fund_id],$_SESSION[donor_id],$_POST[paid_amt],$_POST[payment_type],$_POST[payment_detail],$_POST[status])";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(fund collection record inserted successfully..);</script>";
		echo "<script>window.location=fundcollection.php;</script>";
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
	$sqledit = "SELECT * FROM fund_collection WHERE fund_collection_id=$_GET[editid]";
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
<h1>Fund Collection </h1>
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
	<h4>Fund  Collection</h4>
	</div>
	<p>
<form method="post" action="">
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Fund  </div>
	<div class="col-md-10">
		<select name="fund_id"  id="fund_id" class="form-control">
			<option value="">Select Fund</option>
		</select>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Donor</div>
	<div class="col-md-10">
		<select  name="donor_id"  id="donor_id" class="form-control">
			<option value="">Select Fund</option>
		</select>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Paid amount </div>
	<div class="col-md-10">

		<input type="text" name="paid_amt" id="paid_amt" class="form-control" value="<?php echo $rsedit[paid_amt]; ?>">
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Paid Date </div>
	<div class="col-md-10">
		<input type="text" name="paid_date"  id="paid_date" class="form-control"value="<?php echo $rsedit[paid_date]; ?>">
	</div>
</div>

<br>      

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Payment Type  </div>
	<div class="col-md-10">
		<input type="text" name="payment_type" id="payment_type" class="form-control" value="<?php echo $rsedit[payment_type]; ?>">
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Payment Detail</div>
	<div class="col-md-10">
		<input type="text" name="payment_detail" id="payment_detail" class="form-control" value="<?php echo $rsedit[payment_detail]; ?>">
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

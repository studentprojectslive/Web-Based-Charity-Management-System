<?php
session_start();
include("header.php");
//  
if(isset($_POST[submit]))
{
	$payment_detail = serialize(array($_POST[cardholder],$_POST[cardnumber],$_POST[month],$_POST[cvv]));
	$sql ="INSERT INTO fund_collection( fund_raiser_id, donor_id, name, paid_amt, paid_date, payment_type, payment_detail, status) VALUES($_GET[fund_raiser_id],$_SESSION[donor_id],$_POST[donorname],$_POST[donationamount],$dt,$_POST[payment_type],$payment_detail,Active)";
	$qsql = mysqli_query($con,$sql);	
	if(mysqli_affected_rows($con) == 1)
	{
		$insid = mysqli_insert_id($con);
		echo "<script>alert(Fund collection process completed successfully....);</script>";
		echo "<script>window.location=fundcollectionreceipt.php?fund_collection_id=$insid;</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

$sql = "SELECT * FROM fund_raiser where status=Active AND fund_raiser_id=$_GET[fund_raiser_id]";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);

$perc=0;
$sqlfund_collection = "SELECT SUM(paid_amt) FROM fund_collection where fund_raiser_id=$rs[0] AND status=Active";
$qsqlfund_collection = mysqli_query($con,$sqlfund_collection);
$rsfund_collection = mysqli_fetch_array($qsqlfund_collection);

$perc = ($rsfund_collection[0] * 100 / $rs[fund_amount]);

?>
</header>

<div id="cta" class="section">

<div class="section-bg" style="background-image: url(img/charity/downloadfile.jpg);" data-stellar-background-ratio="0.5"></div>


<div class="container">

<div class="row">

<div class="col-md-offset-2 col-md-8">
<div class="cta-content text-center">
<h1>FUND RAISER</h1>
</div>
</div>

</div>

</div>

</div>



<div class="section">

<div class="container">

<div class="row">

<main id="main" class="col-md-9">

<div class="article causes-details">

<h2 class="article-title"><?php echo $rs[title]; ?></h2>
<div class="article-img">
<?php
		if($rs[banner_img] == "")
		{
			echo "<img src=img/no-image-icon.png style=height: 500px;>";
		}
		else if(file_exists("imgfundraiser/".$rs[banner_img]))
		{
			echo "<img src=imgfundraiser/".$rs[banner_img]. "  style=height: 500px;>";
		}
		else
		{
			echo "<img src=img/no-image-icon.png style=height: 500px; >";	
		}
		?>
</div>


<div class="clearfix">
<div class="causes-progress">
<div class="causes-progress-bar">
<div style="width: <?php 
if($perc > 100)
{
	echo 100;
}
else
{
echo round($perc);
}
?>%;">
<span><?php 
if($perc > 100)
{
	echo 100;
}
else
{
echo round($perc);
}
 ?>%</span>
</div>
</div>
<div>
<span class="causes-raised">Raised: <strong>₹<?php echo $rsfund_collection[0]; ?></strong></span>
<span class="causes-goal">Goal: <strong>₹<?php echo $rs[fund_amount]; ?></strong></span>
</div>
</div>
<a href="" onclick="return false;" class="primary-button causes-donate"  data-toggle="modal" data-target="#myModal">Donate Now</a>
</div>


<div class="article-content">


<ul class="article-meta">
<li><b>Started on <?php echo date("d-M-Y",strtotime($rs[start_date])); ?></b></li>
<li><b>Ends at <?php echo  date("d-M-Y",strtotime($rs[end_date])); ?></b></li>
</ul>

<?php echo $rs[fund_raiser_description]; ?>

</div>


<?php
/*
<div class="article-tags-share">
	<ul class="tags">
	<li>TAGS:</li>
	<li><a href="#">Charity</a></li>
	<li><a href="#">Health</a></li>
	<li><a href="#">Donation</a></li>
	</ul>
	<ul class="share">
	<li>SHARE:</li>
	<li><a href="#"><i class="fa fa-twitter"></i></a></li>
	<li><a href="#"><i class="fa fa-facebook"></i></a></li>
	<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
	<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
	<li><a href="#"><i class="fa fa-instagram"></i></a></li>
	</ul>
</div>
*/
?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Donation panel</h4>
      </div>
      <div class="modal-body">
        <p>
<form method="post" action="" onsubmit="return fun_validate()">
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<b>Donation Amount: </b>
			<input class="input" name="donationamount" id="donationamount" type="number" placeholder="Donation Amount" min="1">
			<span id="errdonationamount" class="errorclass"></span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<b>Donor Name: </b>
			<input class="input" name="donorname" id="donorname" type="text" placeholder="Donor Name" value="<?php echo $rsdonor[name]; ?>">
			<span id="errdonorname" class="errorclass"></span>
		</div>
	</div>
</div><hr>
<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<b>Payment Type: </b>
		<select name="payment_type" id="payment_type" class="form-control">
			<option value="">Select Payment Type</option>
		<?php
		$arr = array("VISA","MASTER CARD","AMERICAN EXPRESS","RUPAY");
		foreach($arr as $val)
		{
			echo "<option vlaue=$val>$val</option>";
		}
		?>
		</select>
			<span id="errpayment_type" class="errorclass"></span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<b>Card holder: </b>
		<input class="input" type="text" name="cardholder" id="cardholder" placeholder="Card holder" >
			<span id="errcardholder" class="errorclass"></span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<b>Card Number: </b>
		<input name="cardnumber" id="cardnumber" class="input" type="number" placeholder="Card Number">
		<span id="errcardnumber" class="errorclass"></span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<b>Expiry date: </b>
		<input class="input" type="month" name="month" id="month" placeholder="Expiry date">
		<span id="errmonth" class="errorclass"></span>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<b>CVV Number: </b>
		<input class="input" placeholder="CVV Number" name="cvv" id="cvv" type="number" min="101" max="999">
		<span id="errcvv" class="errorclass"></span>
	</div>
</div>
</div>
		
		</p>
      </div>
      <div class="modal-footer">
<button class="primary-button" type="submit" name="submit">Make Payment</button>
      </div>
    </div>

</form>
  </div>
</div>
</div>

</main>


<aside id="aside" class="col-md-3">


<div class="widget">

	<h3 class="widget-title">Recent Donations</h3>

	<?php
	$sql = "SELECT * FROM fund_collection LEFT JOIN donor ON donor.donor_id=fund_collection.donor_id LEFT JOIN fund_raiser on fund_raiser.fund_raiser_id=fund_collection.fund_raiser_id where fund_collection.status=Active ORDER BY fund_collection_id DESC LIMIT 4";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
	?>
	<div class="widget-post">
		<a href="#">
		<div class="widget-img">
		<?php
		if($rs[profile_img] == "")
		{
			echo "<img src=img/no-image-icon.png style=height: 75px;>";
		}
		else if(file_exists("imgdonor/".$rs[profile_img]))
		{
			echo "<img src=imgdonor/".$rs[profile_img]. "  style=height: 75px;>";
		}
		else
		{
			echo "<img src=img/no-image-icon.png style=height: 75px; >";	
		}
		?>
		</div>
		<div class="widget-content">
			<?php
			echo $rs[name];
			?>
			<br>
			Donated ₹<?php echo $rs[paid_amt]; ?>
		</div>
		</a>
	</div>
	<?php
	}
	?>
	
</div>

<hr>

<div class="widget">
<h3 class="widget-title">Top donors</h3>
	<?php
	$sql = "SELECT fund_collection.name, SUM(fund_collection.paid_amt) as subamt, donor.profile_img FROM `fund_collection` left join donor on fund_collection.donor_id=donor.donor_id  GROUP BY fund_collection.donor_id order by SUM(fund_collection.paid_amt) desc limit 4";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
	?>
	<div class="widget-post">
		<a href="#">
		<div class="widget-img">
		<?php
		if($rs[profile_img] == "")
		{
			echo "<img src=img/no-image-icon.png style=height: 75px;>";
		}
		else if(file_exists("imgdonor/".$rs[profile_img]))
		{
			echo "<img src=imgdonor/".$rs[profile_img]. "  style=height: 75px;>";
		}
		else
		{
			echo "<img src=img/no-image-icon.png style=height: 75px; >";	
		}
		?>
		</div>
		<div class="widget-content">
			<?php
			echo $rs[name];
			?>
			<br>
			Donated ₹<?php echo $rs[subamt]; ?>
		</div>
		</a>
	</div>
	<?php
	}
	?>


</div>

</aside>

</div>

</div>

</div>

<?php
include("footer.php");
?>
<script>
function fun_validate()
{
	var i = 0;	
	$(.errorclass).html();
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,6}$/;
	var mobno = /^[6-9]\d{9}$/;
	
	if(document.getElementById("donationamount").value <= 0)
	{
		document.getElementById("errdonationamount").innerHTML = "Minimum donation amount is 1.";
		i = 1;
	}	
	if(document.getElementById("donationamount").value=="")
	{
		document.getElementById("errdonationamount").innerHTML = "Donation Amount should not be empty..";
		i = 1;
	}
	if(!document.getElementById("donorname").value.match(alphaSpaceExp))
	{
		document.getElementById("errdonorname").innerHTML = "Donor name should contain only alphabets..";
		validate = "false";		
	}
	if(document.getElementById("donorname").value=="")
	{
		document.getElementById("errdonorname").innerHTML = "Kindly enter donor name...";
		i = 1;
	}
	if(document.getElementById("payment_type").value=="")
	{
		document.getElementById("errpayment_type").innerHTML = "Kindly select Payment Type...";
		i = 1;
	}
	if(!document.getElementById("cardholder").value.match(alphaSpaceExp))
	{
		document.getElementById("errcardholder").innerHTML = "Card Holder name should contain only alphabets..";
		validate = "false";		
	}
	if(document.getElementById("cardholder").value=="")
	{
		document.getElementById("errcardholder").innerHTML = "Card Holder Should not be empty...";
		i = 1;
	}
	if(document.getElementById("cardnumber").value.length != 16)
	{
		document.getElementById("errcardnumber").innerHTML = "Card Number should contain 16 digits...";
		i = 1;
	}
	if(document.getElementById("cardnumber").value=="")
	{
		document.getElementById("errcardnumber").innerHTML = "Card Number Should not be empty...";
		i = 1;
	}
	if(document.getElementById("month").value=="")
	{
		document.getElementById("errmonth").innerHTML = "Kindly select expiry date...";
		i = 1;
	}
	if(document.getElementById("cvv").value.length != 3)
	{
		document.getElementById("errcvv").innerHTML = "CVV Number should contain 3 digits...";
		i = 1;
	}
	if(document.getElementById("cvv").value=="")
	{
		document.getElementById("errcvv").innerHTML = "CVV Number should not be empty...";
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
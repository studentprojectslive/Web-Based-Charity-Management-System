<?php
session_start();
include("header.php");
if(isset($_POST[submit]))
{	
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE food_donor set donor_id=$_POST[donor_id],address=$_POST[address],city=$_POST[city],pin_code=$_POST[pin_code],food_item_detail=$_POST[food_item_detail],quantity=$_POST[quantity],status=$_POST[status],datetime=$_POST[datetime] WHERE food_donor_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Food donor record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	else
	{
		$sql ="INSERT INTO food_donor(donor_id,address,city,pin_code,food_item_detail,quantity,status,datetime) VALUES($_SESSION[donor_id],$_POST[address],$_POST[city],$_POST[pin_code],$_POST[food_item_detail],$_POST[quantity],Pending,$_POST[datetime])";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Food donor Entry done successfully..);</script>";
			echo "<script>window.location=viewfooddonor.php;</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM food_donor WHERE food_donor_id=$_GET[editid]";
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
<h1>Food Donor</h1>
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
	<h4>Food Donor</h4>
	</div>
	<p>
<form method="post" action="" onsubmit="return validateform()">
<input type="hidden" name="donor_id"  id="donor_id" class="form-control" value="<?php echo $rsdonor[donor_id]; ?>">
	<span id="errdonor_id" class="errorclass"></span>

<br>


<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Food Item Detail  </div>
	<div class="col-md-10">
		<textarea name="food_item_detail"  id="food_item_detail" class="form-control" rows="6" ><?php echo $rsedit[food_item_detail]; ?></textarea>
	<span id="errfood_item_detail" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Quantity </div>
	<div class="col-md-10">
		<input type="number" name="quantity"  id="quantity" class="form-control" value="<?php echo $rsedit[quantity]; ?>">
	<span id="errquantity" class="errorclass"></span>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Pick Up Address  </div>
	<div class="col-md-10">
		<textarea name="address"  rows="4" id="address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
	<span id="erraddress" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">City  </div>
	<div class="col-md-10">
		<input type="text" name="city"  id="city" class="form-control" value="<?php echo $rsedit[city]; ?>">
	<span id="errcity" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">PIN code  </div>
	<div class="col-md-10">
		<input type="number" name="pin_code"  id="pin_code" class="form-control" value="<?php echo $rsedit[pin_code]; ?>" min="100001" max="999999">
	<span id="errpin_code" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Pick up Date Time </div>
	<div class="col-md-10">
		<input type="datetime-local" name="datetime"  id="datetime" class="form-control" value="<?php echo $rsedit[datetime]; ?>">
	<span id="errdatetime" class="errorclass"></span>
	</div>
</div>


<br>
<?php
if(isset($_SESSION[staff_id]))
{
?>
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
<?php
}
else
{
?>
<input type=hidden name="status" id="status" value="Pending" >
	<span id="errstatus" class="errorclass"></span>
<?php
}
?>
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
	$(.errorclass).html();
	if(document.getElementById("food_item_detail").value == "")
	{
		document.getElementById("errfood_item_detail").innerHTML = "Food item detail should not be empty..";
		i=1;
	}
	if(document.getElementById("quantity").value == "")
	{
		document.getElementById("errquantity").innerHTML = "Quantity should not be empty..";
		i=1;
	}
	if(document.getElementById("address").value == "")
	{
		document.getElementById("erraddress").innerHTML = "Address should not be empty..";
		i=1;
	}	
	if(document.getElementById("city").value == "")
	{
		document.getElementById("errcity").innerHTML = "City should not be empty..";
		i=1;
	}
	if(document.getElementById("pin_code").value == "")
	{
		document.getElementById("errpin_code").innerHTML = "PIN Code should not be empty..";
		i=1;
	}
	if(document.getElementById("datetime").value == "")
	{
		document.getElementById("errdatetime").innerHTML = "Date time should not be empty..";
		i=1;
	}
	if(document.getElementById("status").value == "")
	{
		document.getElementById("errstatus").innerHTML = "Status should not be empty..";
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
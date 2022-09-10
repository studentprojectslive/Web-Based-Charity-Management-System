<?php
include("header.php");
if(isset($_POST[submit]))
{
	$description = mysqli_real_escape_string($con,$_POST[fund_raiser_description]);
	$banner_img = rand() . $_FILES["banner_img"]["name"];
	move_uploaded_file($_FILES["banner_img"]["tmp_name"],"imgfundraiser/".$banner_img);
	if(isset($_GET[editid]))
	{
		 $sql ="UPDATE fund_raiser SET title=$_POST[title],fund_raiser_description=$description,fund_amount=$_POST[fund_amount],start_date=$_POST[start_date], end_date=$_POST[end_date],status=$_POST[status]";
		 if($_FILES["banner_img"]["name"] != "")
		 {
			 $sql = $sql . " , banner_img=$banner_img ";
		 }
		 $sql =$sql . " WHERE fund_raiser_id=$_GET[editid]";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Fund  Raiser Request updated successfully..);</script>";
		}	
	}
	else
	{
		$sql ="INSERT INTO  fund_raiser(title,fund_raiser_description,fund_amount,start_date, end_date,status,banner_img) VALUES($_POST[title],$description,$_POST[fund_amount],$_POST[start_date],$_POST[end_date],$_POST[status],$banner_img)";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Fund  Raiser Request added successfully..);</script>";
			//echo "<script>window.location=fund.php;</script>";
		}
	}
}
if(isset($_GET[editid]))
{
	$sqledit = "SELECT * FROM fund_raiser WHERE fund_raiser_id=$_GET[editid]";
	$qsqledit = mysqli_query($con,$sqledit);
	echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>

<div id="page-header">
<div class="section-bg" style="background-image: url(img/background-2.jpg);"></div>
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="header-content">
<h1>Fund Raiser</h1>
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
	<h4>Fund Raiser</h4>
	</div>
	<p>
<form method="post" action="" enctype="multipart/form-data" onsubmit="return validateform()">
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Title </div>
	<div class="col-md-10">
		<input type="text" name="title"  id="title" class="form-control" value="<?php echo $rsedit[title]; ?>">
		<span id="errtitle" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Banner Image </div>
	<div class="col-md-10">
		<input type="file" name="banner_img"  id="banner_img" class="form-control" >
		<span id="errbanner_img" class="errorclass"></span>
<?php
if($rsedit[banner_img] == "")
{
}
else if(file_exists("imgfundraiser/".$rsedit[banner_img]))
{
	echo "<img src=imgfundraiser/".$rsedit[banner_img]. " style=width: 250px;height: 250px; >";
}
?>
	</div>
</div>

<br>


<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Description</div>
	<div class="col-md-10">
	<textarea name="fund_raiser_description"  id="fund_raiser_description" class="form-control"><?php echo $rsedit[fund_raiser_description]; ?></textarea>
	<span id="errfund_raiser_description" class="errorclass"></span>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Start Date </div>
	<div class="col-md-10">
		<input type="date" name="start_date"  id="start_date" class="form-control" value="<?php echo $rsedit[start_date]; ?>" min="<?php echo date("Y-m-d"); ?>">
		<span id="errstart_date" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">End Date </div>
	<div class="col-md-10">
		<input type="date" name="end_date"  id="end_date" class="form-control" value="<?php echo $rsedit[end_date]; ?>" min="<?php echo date("Y-m-d"); ?>">
		<span id="errend_date" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Amount </div>
	<div class="col-md-10">
		<input type="text" name="fund_amount"  id="fund_amount" class="form-control" value="<?php echo $rsedit[fund_amount]; ?>">
		<span id="errfund_amount" class="errorclass"></span>
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
		</select><span id="errstatus" class="errorclass"></span>
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

<script src="https://cdn.tiny.cloud/1/vkp7vwptosm1ao2ztjqdp0riscxgp2sxw81z6ma02p9h4oqc/tinymce/5/tinymce.min.js" ></script>
<script>tinymce.init({ selector:textarea });</script>
<script>
function validateform()
{
	var i = 0;	
	$(.errorclass).html();
	
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var alphaSpaceNumericExp = /^[0-9a-zA-Z\s]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	if(!document.getElementById("title").value.match(alphaSpaceNumericExp))
	{
		document.getElementById("errtitle").innerHTML = "Entered title not valid...";
		i = 1;
	}
	if(document.getElementById("title").value=="")
	{
		document.getElementById("errtitle").innerHTML = "Kindly enter title...";
		i = 1;
	}
	if(document.getElementById("banner_img").value=="")
	{
		document.getElementById("errbanner_img").innerHTML = "Kindly enter banner image...";
		i = 1;
	}
	if(document.getElementById("fund_raiser_description").value=="")
	{
		document.getElementById("errfund_raiser_description").innerHTML = "Kindly enter fund raiser description...";
		i = 1;
	}
	if(document.getElementById("start_date").value=="")
	{
		document.getElementById("errstart_date").innerHTML = "Kindly enter the Start date...";
		i = 1;
	}
	if(document.getElementById("end_date").value=="")
	{
		document.getElementById("errend_date").innerHTML = "Kindly enter End date...";
		i = 1;
	}
	
	if(!document.getElementById("fund_amount").value.match(numericExp))
	{
		document.getElementById("errfund_amount").innerHTML = "Entered Fund Amount is not valid...";
		i = 1;
	}
	if(document.getElementById("fund_amount").value=="")
	{
		document.getElementById("errfund_amount").innerHTML = "Kindly enter the Fund amount...";
		i = 1;
	}
	
		
	if(document.getElementById("status").value=="")
	{
		document.getElementById("errstatus").innerHTML = "kindly select status...";
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
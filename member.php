<?php
include("header.php");
if(isset($_POST[submit]))
{
	$image = rand() . $_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],"imgmember/".$image);
	$id_proof = rand() .  $_FILES["id_proof"]["name"];
	move_uploaded_file($_FILES["id_proof"]["tmp_name"],"imgidproof/".$id_proof);
	$adress_proof = rand() . $_FILES["adress_proof"]["name"];
	move_uploaded_file($_FILES["adress_proof"]["tmp_name"],"imgaddressproof/".$adress_proof);
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE member set member_type_id=$_POST[member_type_id],name=$_POST[name]";
		if($_FILES["image"]["name"] != "")
		{
		$sql = $sql . ",image=$image";
		}
		$sql = $sql . ",address=$_POST[address],contact_no=$_POST[contact_no]";
		if($_FILES["id_proof"]["name"] != "")
		{
		$sql = $sql . ",id_proof=$id_proof";
		}
		if($_FILES["adress_proof"]["name"] != "")
		{
		$sql = $sql . ",adress_proof=$adress_proof";
		}
		$sql = $sql . ",description=$_POST[description],status=$_POST[status]  WHERE member_id=$_GET[editid]";
		//echo $sql;
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Member record updated successfully..);</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
	else
	{
		$sql ="INSERT INTO member(member_type_id,name,image,address,contact_no,id_proof,adress_proof,description,status) VALUES($_POST[member_type_id],$_POST[name],$image,$_POST[address],$_POST[contact_no],$id_proof,$adress_proof,$_POST[description],$_POST[status])";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert(Member record inserted successfully..);</script>";
			echo "<script>window.location=member.php;</script>";
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
	$sqledit = "SELECT * FROM  member WHERE member_id=$_GET[editid]";
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
<h1>Member </h1>
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
	<h4>Member </h4>
	</div>
	<p>
<form method="post" action="" enctype="multipart/form-data" onsubmit="return validateform()">
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Member Type  </div>
	<div class="col-md-10">
		<select name="member_type_id"  id="member_type_id" class="form-control">
			<option value="">Select Member Type</option>
			<?php
			$sqlmember_type = "SELECT * FROM member_type where status=Active";
			$qsqlmember_type = mysqli_query($con,$sqlmember_type);
			while($rsmember_type = mysqli_fetch_array($qsqlmember_type))
			{
				if($rsmember_type[member_type_id] == $rsedit[member_type_id])
				{
					echo "<option value=$rsmember_type[member_type_id] selected>$rsmember_type[member_type]</option>";
				}
				else
				{
					echo "<option value=$rsmember_type[member_type_id]>$rsmember_type[member_type]</option>";
				}
			}
			?>
		</select>
		<span id="errmember_type_id" class="errorclass"></span>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Name </div>
	<div class="col-md-10">
		<input type="text" name="name"  id="name" class="form-control" value="<?php echo $rsedit[name]; ?>">
		<span id="errname" class="errorclass"></span>
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Image </div>
	<div class="col-md-10">
		<input type="file" name="image"  id="image" class="form-control" >
		<span id="errimage" class="errorclass"></span>
		<?php
		if(isset($_GET[editid]))
		{
			if($rsedit[image] == "")
			{
				$imgname="img/noimage.png";
			}
			else if(file_exists("imgmember/".$rsedit[image]))
			{
				$imgname = "imgmember/".$rsedit[image];
			}
			else
			{
				$imgname="img/noimage.png";
			}
		echo "<img src=$imgname style=width: 100px; height: 124px;>";
		}
		?>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Address  </div>
	<div class="col-md-10">
		<textarea name="address" id="address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
		<span id="erraddress" class="errorclass"></span>
	</div>
</div>


<br>

<div class="row">
	<div class="col-md-2" style="padding-top: 5px;">Contact No. </div>
	<div class="col-md-10">
		<input type="text" name="contact_no"  id="contact_no" class="form-control" value="<?php echo $rsedit[contact_no]; ?>">
		<span id="errcontact_no" class="errorclass"></span>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Address Proof  </div>
	<div class="col-md-10">
		<input type="file" name="adress_proof"  id="adress_proof" class="form-control" >
		<span id="erradress_proof" class="errorclass"></span>
		<?php
		if(isset($_GET[editid]))
		{
			if(file_exists("imgaddressproof/".$rsedit[adress_proof]))
			{
				echo "<a href=imgaddressproof/$rsedit[adress_proof] class=btn btn-success  style=width: 125px; download >Address Proof</a>";
			}
		}
		?>
	</div>
</div>


<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> ID Proof</div>
	<div class="col-md-10">
		<input type="file" name="id_proof"  id="id_proof" class="form-control"  value="<?php echo $rsedit[id_proof]; ?>">
		<span id="errid_proof" class="errorclass"></span>
		<?php
		if(isset($_GET[editid]))
		{
			if(file_exists("imgidproof/".$rsedit[id_proof]))
			{
				echo "<a href=imgidproof/$rsedit[id_proof]  class=btn btn-info  style=width: 125px; download>ID Proof</a>";
			}
		}
		?>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-2" style="padding-top: 5px;"> Description</div>
	<div class="col-md-10">
		<textarea name="description"  id="description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
		<span id="errdescription" class="errorclass"></span>
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
		<span id="errstatus" class="errorclass"></span>
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
<script>
function validateform()
{
	var i = 0;	
	$(.errorclass).html();
	
	if(document.getElementById("member_type_id").value=="")
	{
		document.getElementById("errmember_type_id").innerHTML = "Kindly select Member type...";
		i = 1;
	}
		
	if(document.getElementById("name").value=="")
	{
		document.getElementById("errname").innerHTML = "Kindly enter name....";
		i = 1;
	}
	
	if(document.getElementById("image").value=="")
	{
		document.getElementById("errimage").innerHTML = "Kindly upload the image....";
		i = 1;
	}
	if(document.getElementById("address").value=="")
	{
		document.getElementById("erraddress").innerHTML = "Address should not be empty...";
		i = 1;
	}
	if(document.getElementById("contact_no").value=="")
	{
		document.getElementById("errcontact_no").innerHTML = "Contact Number should not be empty...";
		i = 1;
	}
	if(document.getElementById("adress_proof").value=="")
	{
		document.getElementById("erradress_proof").innerHTML = "Kinldy upload address proof...";
		i = 1;
	}
	if(document.getElementById("id_proof").value=="")
	{
		document.getElementById("errid_proof").innerHTML = "Kindly upload ID proof...";
		i = 1;
	}
	if(document.getElementById("status").value=="")
	{
		document.getElementById("errstatus").innerHTML = "Kindly select status...";
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
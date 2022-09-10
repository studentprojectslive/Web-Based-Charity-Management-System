<?php
session_start();
?>
<?php
include("header.php");
$sqlmember = "SELECT member.*,member_type.member_type FROM member LEFT JOIN member_type ON member.member_type_id=member_type.member_type_id WHERE member.status=Active AND member.member_id=$_GET[member_id]";
$qsqlmember = mysqli_query($con,$sqlmember);
$rsmember = mysqli_fetch_array($qsqlmember);

		if($rsmember[image] == "")
		{
			$imgname="img/noimage.png";
		}
		else if(file_exists("imgmember/".$rsmember[image]))
		{
			$imgname = "imgmember/".$rsmember[image];
		}
		else
		{
			$imgname="img/noimage.png";
		}
?>
</header>


<div id="about" class="section">

<div class="container">

<div class="row">

<div class="col-md-5">
<div class="section-title">
<h2 class="title"><?php echo $rsmember[name]; ?><span style="font-size: 15px;"> (<?php echo $rsmember[member_type]; ?>)</span></h2>
<p class="sub-title"><?php echo $rsmember[description]; ?>.</p>
</div>
</div>


<div class="col-md-6" style="text-align: right;">
<img src="img/charity/IMG_20191210_124518.jpg" alt="" style="width: 300px;" >
</div>

</div>

</div>

</div>


<div id="numbers" class="section">

	<div class="container">

	<div class="row">

		<div class="col-md-6 col-sm-6">
		<div class="number">
		<span>Contact No.</span>
		<h3><?php echo $rsmember[contact_no]; ?></h3>
		</div>
		</div>


		<div class="col-md-6 col-sm-6">
		<div class="number">
		<span>Address</span>
		<p><b><?php echo $rsmember[address]; ?></b></p>
		</div>
		</div>


	</div>

	</div>

</div>

<?php
include("footer.php");
?>
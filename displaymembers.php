<?php
session_start();
?>
<?php
include("header.php");
?>

</header>



<div id="cta" class="section">

<div class="section-bg" style="background-image: url(img/background-1.jpg);" data-stellar-background-ratio="0.5"></div>


<div class="container">

<div class="row">

<div class="col-md-offset-2 col-md-8">
<div class="cta-content text-center">
<h1>Charity Members</h1>
<p class="lead">View Members here...</p>
</div>
</div>

</div>

</div>

</div>

<div id="blog" class="section">

<div class="container">

<div class="row">

<?php
$sqlmember = "SELECT member.*,member_type.member_type FROM member LEFT JOIN member_type ON member.member_type_id=member_type.member_type_id WHERE member.status=Active";
$qsqlmember = mysqli_query($con,$sqlmember);
while($rsmember = mysqli_fetch_array($qsqlmember))
{
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
<div class="col-md-4">
	<div class="article">
		<div class="article-img">
			<a href="displaymemberdetailed.php?member_id=<?php echo $rsmember[0]; ?>">
			<img src=<?php echo $imgname; ?> style="height: 350px;" >
			</a>
		</div>
		<div class="article-content">
			<h3 class="article-title"><a href="displaymemberdetailed.php?member_id=<?php echo $rsmember[0]; ?>"><?php echo $rsmember[name]; ?></a><span style="font-size: 15px;"> (<?php echo $rsmember[member_type]; ?>)</span></h3>
		</div>
	</div>
</div>
<?php
}
?>
</div>

</div>

</div>

<?php
include("footer.php");
?>
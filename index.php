<?php
include("header.php");
?>

<div id="home-owl" class="owl-carousel owl-theme">

<div class="home-item">

<div class="section-bg" style="background-image: url(img/charity/IMG_20191210_133502.jpg);"></div>

<div class="home">
<div class="container">
<div class="row">
<div class="col-md-8">
<div class="home-content">
<h1>Online Charity</h1>
<p class="lead">With your support, we can help more children</p>
</div>
</div>
</div>
</div>
</div>

</div>


<div class="home-item">

<div class="section-bg" style="background-image: url(img/charity/IMG_20191210_133505.jpg);"></div>


<div class="home">
<div class="container">
<div class="row">
<div class="col-md-8">
<div class="home-content">
<h1>Online Charity</h1>
<p class="lead">THIS NEW YEAR, COME TOGETHER TO SUPPORT HEALTH, EDUCATION,
AND DREAMS OF 1.8 MILLION CHILDREN.</p>
</div>
</div>
</div>
</div>
</div>

</div>

</div>

</header>


<div id="about" class="section">

<div class="container">

<div class="row">

<div class="col-md-5">
<div class="section-title">
<h2 class="title">Welcome to Sahaya Charity</h2>
<p class="sub-title">Sahaya Charity is the non-profit organization which helps old people, poor people, Mentally
challenging peoples which is situated in Assaigoli, Konaje, Bangalore.</p>
</div>
<div class="about-content">
<p>Sahaya Charity charity which helps to raise funds online, Online appointment feature for birthday party or any other activities, Online
Children adaption service and many more. Even if any food item remains in any function people can send request to charity..</p>
<a href="about.php" class="primary-button">Read More</a>
</div>
</div>


<div class="col-md-offset-1 col-md-6">
<a href="about.php" class="about-video" style="height: 550px;">
<img src="img/charity/IMG_20191210_124518.jpg" alt="">
</a>
</div>

</div>

</div>

</div>


<div id="numbers" class="section">

	<div class="container">

	<div class="row">

		<div class="col-md-3 col-sm-6">
		<div class="number">
		<i class="fa fa-smile-o"></i>
		<h3>
			<?php
			$sql ="SELECT * FROM donor";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
		</h3>
		<span>Donors</span>
		</div>
		</div>


		<div class="col-md-3 col-sm-6">
		<div class="number">
		<i class="fa fa-heartbeat"></i>
		<h3>
		<?php
		$sql ="SELECT * FROM member";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_num_rows($qsql);
		?>
		</h3>
		<span>Members</span>
		</div>
		</div>


		<div class="col-md-3 col-sm-6">
		<div class="number">
		<i class="fa fa-money"></i>
		<h3><?php
		$sql ="SELECT sum(paid_amt) FROM fund_collection";
		$qsql = mysqli_query($con,$sql);
		$rs = mysqli_fetch_array($qsql);
		echo "₹".round($rs[0]);
		?></h3>
		<span>Donated</span>
		</div>
		</div>


		<div class="col-md-3 col-sm-6">
		<div class="number">
		<i class="fa fa-handshake-o"></i>
		<h3><?php
		$sql ="SELECT * FROM food_donor";
		$qsql = mysqli_query($con,$sql);
		$rs = mysqli_fetch_array($qsql);
		echo mysqli_num_rows($qsql);
		?></h3>
		<span>Food donors</span>
		</div>
		</div>

	</div>

	</div>

</div>

<div id="cta" class="section">

<div class="section-bg" style="background-image: url(img/charity/downloadfile.jpg);" data-stellar-background-ratio="0.5"></div>


<div class="container">

<div class="row">

<div class="col-md-offset-2 col-md-8">
<div class="cta-content text-center">
<h1>Register as DONOR</h1>
<a href="" class="primary-button" onclick="return false" data-toggle="modal" data-target="#DonorLoginModal">Login Panel...</a>
<a href="" class="primary-button" onclick="return false" data-toggle="modal" data-target="#DonorRegisterModal">Join Us Now...</a>
</div>
</div>

</div>

</div>

</div>


<div id="events" class="section">

<div class="container">

<div class="row">

<div class="col-md-8 col-md-offset-2">
<div class="section-title text-center">
<h2 class="title">Sahaya Charity CHARITY</h2>
</div>
</div>


<div class="col-md-6">
<div class="event">
<div class="event-img">
<a href="#">
<img src="img/event-1.jpg" alt="">
</a>
</div>
<div class="event-content">
<h3><a href="#">Help people in need</a></h3>
<p>Provide direct support to an individual, family or community by paying medical expenses or offering financial aid..</p>
</div>
</div>
</div>


<div class="col-md-6">
<div class="event">
<div class="event-img">
<a href="#">
<img src="img/event-2.jpg" alt="">
</a>
</div>
<div class="event-content">
<h3><a href="#">Take action in an emergency</a></h3>

<p>Raise funds in response to a natural disaster or humanitarian crisis. Make a difference in minutes.</p>
</div>
</div>
</div>

<div class="clearfix visible-md visible-lg"></div>

<div class="col-md-6">
<div class="event">
<div class="event-img">
<a href="#">
<img src="img/event-3.jpg" alt="">
</a>
</div>
<div class="event-content">
<h3><a href="#">Take part in a charity event</a></h3>

<p>Choose from hundreds of official events including marathons, bike rides, Dryathlons and bake offs….</p>
</div>
</div>
</div>


<div class="col-md-6">
<div class="event">
<div class="event-img">
<a href="#">
<img src="img/event-4.jpg" alt="">
</a>
</div>
<div class="event-content">
<h3><a href="#">Celebrate an occasion</a></h3>
<p>Mark a special event like a birthday, wedding or final exam by asking friends for donations rather than gifts..</p>
</div>
</div>
</div>

</div>

</div>

</div>

<hr>

<div id="causes" class="section" style="padding: 5px;">

<div class="container">

<div class="row">

<div class="col-md-8 col-md-offset-2">
<div class="section-title text-center">
<h2 class="title">Fund Raiser</h2>
<p class="sub-title">Fundraising or fund-raising is the process of seeking and gathering voluntary financial contributions by engaging individuals, businesses, charitable foundations, or governmental agencies..</p>
</div>
</div>


<?php
	$sql = "SELECT * FROM fund_raiser where status=Active order by fund_raiser_id DESC  limit 3";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$perc=0;
$sqlfund_collection = "SELECT SUM(paid_amt) FROM fund_collection where fund_raiser_id=$rs[0] AND status=Active";
$qsqlfund_collection = mysqli_query($con,$sqlfund_collection);
$rsfund_collection = mysqli_fetch_array($qsqlfund_collection);


 $perc = ($rsfund_collection[0] * 100 / $rs[fund_amount])
?>
<div class="col-md-4">
	<div class="causes">
		<div class="causes-img">
		<a href="funraiserdetailed.php?fund_raiser_id=<?php echo $rs[0]; ?>">		
		<?php
		if($rs[banner_img] == "")
		{
			echo "<img src=img/no-image-icon.png style=height: 300px;>";
		}
		else if(file_exists("imgfundraiser/".$rs[banner_img]))
		{
			echo "<img src=imgfundraiser/".$rs[banner_img]. "  style=height: 300px;>";
		}
		else
		{
			echo "<img src=img/no-image-icon.png style=height: 300px; >";	
		}
		?>
		</a>
		</div>
		<div class="causes-progress">
		<div class="causes-progress-bar">
		<div style="width: <?php echo $perc; ?>%;">
		<span><?php echo $perc ?>%</span>
		</div>
		</div>
		<div>
		<span class="causes-raised">Raised: <strong>₹<?php echo $rsfund_collection[0]; ?></strong></span>
		<span class="causes-goal">Goal: <strong>₹<?php echo $rs[fund_amount]; ?></strong></span>
		</div>
		</div>
		<div class="causes-content">
		<h3><a href="funraiserdetailed.php?fund_raiser_id=<?php echo $rs[0]; ?>"><?php echo  $rs[title]; ?></a></h3>
		<p><?php echo  $string = substr($rs[fund_raiser_description],0,100); ?></p>
		<a href="funraiserdetailed.php?fund_raiser_id=<?php echo $rs[0]; ?>" class="primary-button causes-donate">Donate Now</a>
		</div>
	</div>
</div>
<?php
	}
?>


<div class="clearfix visible-md visible-lg"></div>
</div>
<hr>
</div>

</div>


<div id="events" class="section">
<div class="section-title text-center">
<h2 class="title">Photo Gallery</h2>
</div>
<div class="container">

<div class="row">
<?php
$sqlgallery = "SELECT * FROM album WHERE status=Active ORDER BY album_id DESC limit 4";
$qsqlgallery = mysqli_query($con,$sqlgallery);
while($rsgallery  = mysqli_fetch_array($qsqlgallery))
{
echo "<script type=text/javascript>
    $(function(){
        //prepare Your data array with img urls
        var dataArray=new Array();";
	$sql = "SELECT * FROM photo WHERE album_id=$rsgallery[album_id]";
	$qsql = mysqli_query($con,$sql);
	$ik=0;
	while($rs = mysqli_fetch_array($qsql))
	{		
        echo "dataArray[$ik]=imgphoto/$rs[photo];";
		$ik = $ik + 1;
	}
		/*
        dataArray[1]=img/post-2.jpg;
        dataArray[2]=img/post-3.jpg;
        dataArray[3]=img/post-4.jpg;
        dataArray[4]=img/post-5.jpg;
		*/
echo "
        //start with id=0 after 5 seconds
        var thisId=0;

        window.setInterval(function(){
            $(#thisImg$rsgallery[0]).attr(src,dataArray[thisId]);
            thisId++; //increment data array id
            if (thisId==4) thisId=0; //repeat from start
        },2000);        
    });
</script>";
?>
	<div class="col-md-3">
		<div class="article">
		 <div class="article-img">
		<a href="displayphotos.php?album_id=<?php echo $rsgallery[0]; ?>">
<?php
	$sqlphoto = "SELECT * FROM photo WHERE album_id=$rsgallery[album_id]";
	$qsqlphoto = mysqli_query($con,$sqlphoto);
	$ik=0;
	$rsphoto = mysqli_fetch_array($qsqlphoto);
?>		
			<img src="imgphoto/<?php echo $rsphoto[photo]; ?>" id=thisImg<?php echo $rsgallery[0]; ?> alt="">
		</a>
		</div>
		<div class="article-content">
		<h3 class="article-title"><a href="displayphotos.php?album_id=<?php echo $rsgallery[0]; ?>"><?php echo $rsgallery[album_title]; ?></a></h3>
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
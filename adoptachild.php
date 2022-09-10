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
<h1>Adopt A Child</h1>
<p class="lead">Help us find solutions for the 25 million children who are separated from their families.</p>
</div>
</div>

</div>

</div>

</div>

<div id="blog" class="section">

<div class="container">

<div class="row">

<?php
$sqlmember = "SELECT member.*,member_type.member_type FROM member LEFT JOIN member_type ON member.member_type_id=member_type.member_type_id WHERE member.status=Active AND member.member_type_id=1";
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
			<a href="adoptachildapply.php?member_id=<?php echo $rsmember[0]; ?>">
			<img src=<?php echo $imgname; ?> style="height: 350px;" >
			</a>
		</div>
		<div class="article-content">
			<h3 class="article-title"><a href="displaymemberdetailed.php?member_id=<?php echo $rsmember[0]; ?>"><?php echo $rsmember[name]; ?></a></h3>
			<a type="button" class="btn btn-info" href="adoptachildapply.php?member_id=<?php echo $rsmember[0]; ?>" >View Profile</a>
		</div>
	</div>
</div>
<?php
}
?>
</div>

<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>


</div>

</div>
<div id="cta" class="section">
	<div class="section-bg" style="background-image: url(img/background-1.jpg);" data-stellar-background-ratio="0.5"></div>
	<div class="container">
		<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="cta-content text-center">
				<h1>How to Adopt a Child?</h1>
					<p class="lead" style="text-align: left;color: white;">	
					<b>
		- The adoptive parents shall be physically, mentally and emotionally stable, financially capable and shall not have any life threatening medical condition.<br>
		- Any prospective adoptive parents, irrespective of his marital status and whether or not he has biological son or daughter, can adopt a child subject to following, namely:-<bR>
		&nbsp; &nbsp; &nbsp; a) the consent of both the spouses for the adoption shall be required, in case of a married couple;<bR>
		&nbsp; &nbsp; &nbsp; b) a single female can adopt a child of any gender;<bR>
		&nbsp; &nbsp; &nbsp; c) a single male shall not be eligible to adopt a girl child<bR>
		- No child shall be given in adoption to a couple unless they have at least two years of stable marital relationship.<bR>
		
		- In case of couple, the composite age of the prospective adoptive parents shall be counted.<bR>
		
- The minimum age difference between the child and either of the prospective adoptive parents shall not be less than twenty-five years.<bR>

- The age criteria for prospective adoptive parents shall not be applicable in case of relative adoptions and adoption by step-parent.<bR>

- Couples with three or more children shall not be considered for adoption except in case of special need children as defined in sub-regulation (21) of regulation 2, hard to place children as mentioned in regulation 50 and in case of relative adoption and adoption by step-parent.</b></p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include("footer.php");
?>
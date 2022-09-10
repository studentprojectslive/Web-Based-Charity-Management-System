<?php
include("header.php");
$sqlgallery = "SELECT * FROM album WHERE status=Active AND album_id=$_GET[album_id]";
$qsqlgallery = mysqli_query($con,$sqlgallery);
$rsgallery  = mysqli_fetch_array($qsqlgallery);
?>

<div id="page-header">

<div class="section-bg" style="background-image: url(img/background-2.jpg);"></div>


<div class="container">
<div class="row">
<div class="col-md-12">
<div class="header-content">
<h1>Photos of <?php echo $rsgallery[album_title]; ?> album...</h1>
<p><?php echo $rsgallery[album_description]; ?></p>
</div>
</div>
</div>
</div>

</div>

</header>


<div class="section">

<div class="container">

<div class="row">

<main id="main" class="col-md-12">
<div class="row">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php
	$sql = "SELECT * FROM photo WHERE album_id=$rsgallery[album_id]";
	$qsql = mysqli_query($con,$sql);
	$ik=0;
	while($rsphoto = mysqli_fetch_array($qsql))
	{		
?>
	<div class="col-md-4">
		<div class="article">
		 <div class="article-img">
		<a href="" target="false" data-toggle="modal" data-target="#myModal<?php echo $rsgallery[0]; ?>"><img src="imgphoto/<?php echo $rsphoto[photo]; ?>" id=thisImg<?php echo $rsgallery[0]; ?> alt=""></a>
		</div>
		<div class="article-content">
		<h2 class="article-title"><a href="" target="false" data-toggle="modal" data-target="#myModal<?php echo $rsgallery[0]; ?>"><?php echo $rsgallery[photo_title]; ?></a></h2>
		<center><b><?php echo $rsphoto[photo_title]; ?></b></center>
		</div>
		</div>
	</div>
	
<div id="myModal<?php echo $rsgallery[0]; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $rsphoto[photo_title]; ?></h4>
      </div>
      <div class="modal-body">
        <p><img src="imgphoto/<?php echo $rsphoto[photo]; ?>" id=thisImg<?php echo $rsgallery[0]; ?> alt="" style="width:100%;">
		<h3><?php echo $rsphoto[photo_title]; ?></h3>
		<?php /*<br>
		<?php echo $rsphoto[photo_description]; ?>
		*/
		?>
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php
}
?>
</div>
</main>


</div>

</div>

</div>

<?php
include("footer.php");
?>
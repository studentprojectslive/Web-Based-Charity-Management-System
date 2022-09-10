<?php
session_start();
?>
<?php
include("header.php");
if(!isset($_SESSION[staff_id]))
{
	echo "<script>window.location=index.php;</script>";
}
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM photo WHERE photo_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(photo record deleted successfully..);</script>";
		echo "<script>window.location=viewphoto.php;</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
</header>
<div id="about" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="section-title">
			<center><h2 class="title">View Photo</h2></center>
			</div>
			</div>
		</div>
	</div>
</div>


<div id="numbers" class="section">

<div class="container">

<div class="row">

<div class="col-md-12 col-sm-12">
	<div class="number">

<table id="datatable"  class="table table-striped table-bordered">
	<thead>
		<tr>
			<th style=text-align: left;>Album</th>
			<th style=text-align: left;>Photo</th>
			<th style=text-align: left;>Photo Title</th>
			<th style=text-align: left;>Photo Description</th>
			<th style=text-align: left;>Status</th>
			<th style=text-align: left;>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM photo LEFT JOIN album ON photo.album_id=album.album_id";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td style=text-align: left;>$rs[album_title]</td>
			<td style=text-align: left;><img src=imgphoto/$rs[photo] style=width: 150px; height: 125px;></td>
			<td style=text-align: left;>$rs[photo_title]</td>
			<td style=text-align: left;>$rs[photo_description]</td>
			<td style=text-align: left;>$rs[status]</td>
			<td style=text-align: left;>
			
			<a href=viewphoto.php?delid=$rs[0] class=btn btn-danger onclick=return confirmdel() >Delete</a>
				<a href=photo.php?editid=$rs[0]  class=btn btn-primary >Edit</a>
			
		</td>
		<tr>";
			
	}
		?>	
	</tbody>
</table>

	</div>
</div>

</div>

</div>

</div>

<?php
include("footer.php");
?>
<script>
function confirmdel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
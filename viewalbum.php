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
	$sql = "DELETE FROM album WHERE album_id=$_GET[delid]";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert(Album record deleted successfully..);</script>";
		echo "<script>window.location=viewalbum.php;</script>";
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
			<center><h2 class="title">view album</h2></center>
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
			<th>Album title</th>
			<th>Album description</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM album";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td style=text-align: left;>$rs[album_title]</td>
			<td style=text-align: left;>$rs[album_description]</td>
			<td style=text-align: left;>$rs[status]</td>
			<td style=text-align: left;>
			
			<a href=viewalbum.php?delid=$rs[0] class=btn btn-danger onclick=return confirmdel() >Delete</a>
				<a href=album.php?editid=$rs[0]  class=btn btn-primary >Edit</a>
			
			</td>
			</tr>";
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
<?php
include("header.php");
if(!isset($_SESSION[staff_id]) && !isset($_SESSION[donor_id]))
{
	echo "<script>window.location=index.php;</script>";
}
if(isset($_GET[status]))
{
	$adaptno=0;
	if($_GET[status] == "Approved")
	{
		$sqlchild_adoption1 = "SELECT * FROM child_adoption WHERE child_adoption_status=Approved ";
		$qsqlchild_adoption1 = mysqli_query($con,$sqlchild_adoption1);
		echo mysqli_error($con);
		$rsidonor = mysqli_fetch_array($qsqlchild_adoption1);
		if(mysqli_num_rows($qsqlchild_adoption1) == 1)
		{
			$adaptno= mysqli_num_rows($qsqlchild_adoption1);
			echo "<script>alert(This child Account is already in Approval status...);</script>";
			echo "<script>window.location=viewadoptchildapply.php;</script>";	
		}
	}
	if($adaptno == 0)
	{
		$sqldel = "UPDATE child_adoption SET child_adoption_status=$_GET[status] where child_adoption_id=$_GET[editid]";
		$qsqldel = mysqli_query($con,$sqldel);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			if($_GET[status] == "Approved")
			{
				$sqlchild_adoption2 = "SELECT * FROM child_adoption WHERE  child_adoption_id=$_GET[editid] ";
				$qsqlchild_adoption2 = mysqli_query($con,$sqlchild_adoption2);
				$rsidonor2 = mysqli_fetch_array($qsqlchild_adoption2);
				 $sqlupddonor ="UPDATE member SET status=Adopted WHERE member_id=$rsidonor2[member_id]";
				$qsqlupd = mysqli_query($con,$sqlupddonor);	
				echo mysqli_error($con);
			}
			echo "<script>alert(Child Adoption status updated successfully..);</script>";
			echo "<script>window.location=viewadoptchildapply.php;</script>";	
		}
	}
}
if(isset($_GET[delid]))
{
	$sqldel = "DELETE FROM child_adoption where child_adoption_id=$_GET[delid]";
	$qsqldel = mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert(Record deleted successfully..);</script>";
	echo "<script>window.location=viewadoptchildapply.php;</script>";	
	}
}
?>
</header>
<div id="about" class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="section-title">
			<center><h2 class="title">View Child Adoption detail</h2></center>
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
			<th>Image</th>
			<th>Child</th>
			<th>Donor Detail</th>
			<th>Adoption Detail</th>
			<th style="width: 150px;">Adoption Status</th>	
			<?php
			if(isset($_SESSION[staff_id]))
			{
			?>
			<th>Action</th>
			<?php
			}
			?>
		</tr>
	</thead>
	<tbody>
<?php
	$sql = "SELECT * FROM child_adoption WHERE child_adoption_status!= ";
	if(isset($_SESSION[donor_id]))
	{
		$sql = $sql . " AND donor_id=$_SESSION[donor_id]";
	}
	//echo $sql;
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqldonor  ="SELECT * FROM donor WHERE donor_id=$rs[donor_id]";
		$qsqldonor =mysqli_query($con,$sqldonor);
		echo mysqli_error($con);
		$rsdonor = mysqli_fetch_array($qsqldonor);		
		$sqlmember = "SELECT member.*,member_type.member_type FROM member LEFT JOIN member_type ON member.member_type_id=member_type.member_type_id WHERE member.status=Active AND member.member_type_id=1 AND member.member_id=$rs[member_id]";
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
		
		echo "<tr>
			<td style=text-align: left;><img src=$imgname style=width: 75px; height: 75px; ></td>
			<td style=text-align: left;>$rsmember[name]</td>
			<td style=text-align: left;>
				<b>$rsdonor[name]</b><br>
				<b>Email -</b> $rsdonor[email_id] <br>
				<b>Ph No. -</b> $rsdonor[contact_no]
			</td>";
		echo "<td style=text-align: left;><a href=adoptachildapply.php?member_id=$rs[member_id]&donor_id=$rs[donor_id]  class=btn btn-primary target=_blank >View</a></td>";
		echo "<td style=text-align: left;>$rs[child_adoption_status]</td>";
		if($rs[child_adoption_status] == "Approved" )
		{
			echo "<td style=text-align: left;></td>";
		}
		else
		{
			if(isset($_SESSION[staff_id]))
			{
			echo "<td style=text-align: left;>
				<a href=viewadoptchildapply.php?editid=$rs[0]&status=Approved class=btn btn-success >Approve</a>
				<a href=viewadoptchildapply.php?editid=$rs[0]&status=Rejected class=btn btn-warning >Reject</a>
				<a href=viewadoptchildapply.php?delid=$rs[0] class=btn btn-danger onclick=return confirmdel() >Delete</a>
				</td>";
			}
		}
		echo "</tr>";
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
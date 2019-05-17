<?php
include_once("config.php");

$sql = "SELECT * FROM mahasiswa";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $record = mysqli_fetch_assoc($resultset) ) {
?>
<div class="card hovercard">
<div class="cardheader">
<div class="avatar">
<img alt="" src="<?php echo $record['image']; ?>">
</div>
</div>
<div class="card-body info">
<div class="title">
<a href="#"><?php echo $record['name']; ?></a>
</div>
<div class="desc"> <a target="_blank" href="<?php echo $record['website']; ?>"><?php echo $record['website']; ?></a></div>
<div class="desc"><?php echo $record['description']; ?></div>
<div class="desc"><?php echo $record['address']; ?></div>
</div>
<div class="card-footer bottom">
<a class="btn btn-primary btn-twitter btn-sm" href="<?php echo $record['twitter']; ?>">
<i class="fa fa-twitter"></i>
</a>
<a class="btn btn-danger btn-sm" rel="publisher"
href="<?php echo $record['gplus']; ?>">
<i class="fa fa-google-plus"></i>
</a>
<a class="btn btn-primary btn-sm" rel="publisher"
href="<?php echo $record['facebook']; ?>">
<i class="fa fa-facebook"></i>
</a>
</div>
</div>
<?php } ?>
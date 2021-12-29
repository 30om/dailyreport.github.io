<?php
require_once('partials/_header.php');
require_once('partials/_nav_bar.php');
require_once('../db.php');
$sql = "SELECT * FROM subjects";
$result = mysqli_query($conn, $sql);
?>
<div class="container">
    <div class="card m-1">
        <div class="card-body">
            
  </div>
</div>
</div>

<?php
require_once('partials/_footer.php');
?>
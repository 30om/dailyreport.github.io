<?php
require_once('../db.php');

if(isset($_POST['update_s'])){
    $update_days=updateDays($_POST['sid'],$_POST['days']);
    if($update_days){
        $_SESSION['update_subject']=TRUE;        
        header("Location: update_subject_details.php?sid=".$_POST['sid']."");

    }
}   

?>  
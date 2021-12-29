<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "class_report";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
session_start();

function subjectDetails($subject_id){
  global $conn;
  $sql="select * from subjects where id=$subject_id";
  $result = mysqli_query($conn, $sql);
  return  mysqli_fetch_assoc($result);
 
}

function courseDetails($course_id){
  global $conn;
  $sql="select * from courses where id=$course_id";
  $result = mysqli_query($conn, $sql);
  return  mysqli_fetch_assoc($result);
 
}

/*function saveReport($class_id,$student_count,$date){
  global $conn;
  $sql="insert into daily_report values ({$class_id},{$student_count},{$date})";
  $result = mysqli_query($conn, $sql);
  return   $result;
 
}*/

function faculty($fid){
  global $conn;    
  $faculty="SELECT * FROM teachers where id=$fid";
  $result = mysqli_query($conn, $faculty);
  return  mysqli_fetch_assoc($result);

}

function updateDays($sid,$d_array){
  global $conn;
  $delete_old_q="DELETE FROM class_days WHERE subject_id=$sid";
  $delete_old = mysqli_query($conn, $delete_old_q); 

  foreach($d_array as $did){
    $insert="INSERT INTO class_days (day_id, subject_id) VALUES ($did, $sid)";
    $update = mysqli_query($conn, $insert);
  }

  return TRUE;
}

function subjectdays($sid){
  global $conn;    
  $days="SELECT * FROM class_days where subject_id	=$sid";
  $result = mysqli_query($conn, $days);
  return  $result;

}

function dayWiseSubjects($dayid){
  global $conn;    
  $subjects="SELECT subject_id FROM class_days where day_id	=$dayid";
  $result = mysqli_query($conn, $subjects);
  return  $result;
}

?>
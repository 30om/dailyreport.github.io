<?php
require_once('partials/_header.php');
require_once('partials/_nav_bar.php');
require_once('../db.php');
$sql = "SELECT * FROM subjects";
$result = mysqli_query($conn, $sql);
$day_a=array(1=>"Mon", 2=>"Tue", 3=>"Wed", 4=>"Thu", 5=>"Fri", 6=>"Sat");

?>
<div class="container">
    <div class="card m-1">
        <div class="card-body">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Course/Semester </th>                        
                        <th scope="col">Total Students</th>
                        <th scope="col">Faculty Assigned</th>                       
                        <th scope="col">Days</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    foreach($result as $subject){  
                        $course = courseDetails($subject['course_id']); 
                        $days_str='';
                        foreach(subjectdays($subject['id']) as $days){
                            $days_str.=$day_a[$days['day_id']].', ';
                            //echo $day_a[$days['day_id']];
                           
                        }
                        ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $subject['subject_code'].' '.$subject['subject_title']; ?></td>
                        <td><?php echo $course['course_name']; ?></td>
                        <td><?php echo $course['students']; ?></td>
                        <td><?php echo faculty($subject['subject_teacher_id'])['name']; ?></td>
                        <td><?php  echo rtrim($days_str, ", "); ?></td>
                        <td><a href="update_subject_details.php?sid=<?php echo $subject['id'] ?>" class="link-warning">Update</a></td>
                    </tr>
                <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once('partials/_footer.php');
?>
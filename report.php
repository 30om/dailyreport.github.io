<?php
require_once('partials/_header.php');
require_once('partials/_nav_bar.php');
require_once('db.php');





$class=$_POST['class'];
$count=$_POST['count'];
$date=new DateTime($_POST['date']);

$c = array_combine($class, $count);
$i=1;
?>
 <div class="container">
        <div class="card m-1">
            <div class="card-body" id="report_div">
                <h4 class="text-center">KUMAUN UNIVERSITY, NAINITAL <br>DAILY STUDENT ATTENDANCE REPORT <br>Department of Computer Science, D.S.B Campus Nainital</h4>
                <table class="table table-bordered border-primary" >
                    <thead>
                        <tr>
                            <th style="text-align: center;" scope="col" colspan="8" ><?php echo $date->format('D, d F Y'); ?></th>
                        </tr>
                        <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Course/Semester </th>
                        <th scope="col">Class Duration<br>(in hours)</th>
                        <th scope="col">Total Students</th>
                        <th scope="col">Students Present</th>
                        <th scope="col">Present Percentage(%)</th>
                        <!--<th scope="col">Remark</th>-->
                       
                        </tr>
                    </thead>
                    <tbody>
            <?php
            foreach($c as $sid => $student_present) {
               // echo "$sid  = $student_present<br>";    
                $sub = subjectDetails($sid);
                $course = courseDetails($sub['course_id']);
                
               // echo $course['course_name']; 
                     ?>   
                        <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $sub['subject_code'].' '.$sub['subject_title']; ?></td>
                        <td><?php echo $course['course_name']; ?></td>
                        <td><?php echo $course['class_duration']; ?></td>
                        <td><?php echo $course['students']; ?></td>
                        <td><?php echo $student_present; ?></td>
                        <td><?php echo round(($student_present/$course['students'])*100,2); ?></td>     
                        <!--<td><div class="form-control" contenteditable="true"></div></td>-->                                        
                        </tr>
                        <?php $i++; 
                        }
            ?>       
                    </tbody>
                </table>
                
            </div>
           
        </div>
        <div class="col-12">
                    <input type="button" class="btn btn-primary" value="Print Report" onclick="printReport()">
                   
                </div>
    </div>
<script>
    function printReport(){        
            var divContents = document.getElementById("report_div").innerHTML;
            var a = window.open('', '', 'height=1000, width=1000');
            a.document.write('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">');
            a.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">');            
            a.document.write('<title><?php echo $date->format('D, d F Y'); ?></title>');  
            a.document.write('</head><body>');                     
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();        
    }
</script>
</body>
</html>
    

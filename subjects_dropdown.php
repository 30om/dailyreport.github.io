<?php
require_once('db.php');
$week_day=$_POST['week_day'];
$subject_ids=dayWiseSubjects($week_day);
$response='';
$sql = "SELECT * FROM subjects";
$result = mysqli_query($conn, $sql);
$i=1;
foreach($subject_ids as $subject_id){
    $response.='<div class="row" id="pr_'.$i.'">
    <div class="col-md-4" >
        <label for="validationCustom04" class="form-label">Subjects</label>
        <select name="class[]" class="form-select select-multiple-tag" id="validationCustom04" required > 
          <option></option>';
          foreach($result as $row){ 
            $select = $subject_id['subject_id']==$row["id"] ? "Selected" : "";
              
            $response.='<option value="'.$row["id"].'" '.$select.'> '.$row["subject_code"].' '.$row["subject_title"].' '.faculty($row["subject_teacher_id"])["name"].' </option>';
           }                 
           $response.='</select>
        <div class="invalid-feedback">Please select a valid Subject.</div>
    </div>
    <div class="col-md-4">
        <label for="validationCustomUsername" class="form-label">No. of Students Present</label>
            <div class="input-group has-validation">                    
            <input type="number" name="count[]" class="form-control" id="validationCustomUsername" value="" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
            Enter No. of Students Present
                </div>
            </div>
    </div>
    <div class="col-md-4">
        <label for="validationCustomUsername" class="form-label"></label>
            <div class="input-group ">    
              <i class="fas fa-trash btn btn-danger" onclick="remove('.$i.')"></i>                              
        </div>
    </div>
  </div>';
  $i++;
    //echo subjectDetails($subject_id['subject_id'])['subject_title'];
}
//echo $response;
//print_r($subjects['subject_id']);
echo json_encode(array('count' => $i,'data'=>$response));

?>

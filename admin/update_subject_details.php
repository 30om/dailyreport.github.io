<?php
require_once('partials/_header.php');
require_once('partials/_nav_bar.php');
require_once('../db.php');
$subject_id=$_REQUEST['sid'];
$subject_details=subjectDetails($subject_id);
$day_fetch_id=[];
    foreach(subjectdays($subject_id) as $days){
        array_push($day_fetch_id,$days['day_id']); 
    }

function arrayFind($day_id){
    global $subject_id,$day_fetch_id;     
    if(array_search($day_id,$day_fetch_id)!=''){
        $result='selected';
    }
    else{
        $result='';
    }
    return $result;
}

?>
<div class="container">

    <div class="card m-1 ">
        
        <div class="card-header bg-primary text-white">
            Update Subject
        </div>
        <div class="card-body">
            <?php if(isset($_SESSION['update_subject'])){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-thumbs-up"></i> Subject Details Updated Successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php unset($_SESSION['update_subject']); } ?> 
           <?php echo $subject_details['subject_code'].' '.$subject_details['subject_title'] ?>
           <form method="post" action="update_sub.php">
               <input type="hidden" name="sid" value="<?php echo $subject_id; ?>">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="col-form-label">Days Schedule</label>
                    </div>
                    <div class="col-md-6">
                        <select name="days[]" class="form-select select-multiple-tag" multiple="multiple"  required> 
                            <option <?php echo arrayFind(1); ?> value="1">Monday</option>
                            <option <?php echo arrayFind(2); ?> value="2">Tuesday</option>
                            <option <?php echo arrayFind(3); ?> value="3">Wednesday</option>
                            <option <?php echo arrayFind(4); ?> value="4">Thursday</option>
                            <option <?php echo arrayFind(5); ?> value="5">Friday</option>
                            <option <?php echo arrayFind(6); ?> value="6">Saturday</option>
                            
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a onClick="history.go(-1);" class="btn btn-primary" role="button" data-bs-toggle="button">Back</a>
                        <button class="btn btn-warning" name="update_s" type="Submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once('partials/_footer.php');
?>
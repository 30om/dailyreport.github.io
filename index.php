<?php
require_once('partials/_header.php');
require_once('partials/_nav_bar.php');
require_once('db.php');
$sql = "SELECT * FROM subjects";
$result = mysqli_query($conn, $sql);
?>
<div class="container">
  <div class="card m-1">
    <div class="card-body">
      <form class="row g-3 needs-validation" novalidate method="post" action="report.php">
        <div class="col-md-4">
          <label class="form-label">Date</label>
          <input type="date" name="date" class="form-control" id="dateInput" onchange="changeDate()" required>
          <div class="valid-feedback">
            Looks good!
          </div>
          
        </div>
        <div class="col-md-4" id="loader"  style="display: none;">
          <div class="spinner-border text-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
        <div class="col-md-2">

        </div>
        <div class="col-md-2"></div>
        <input type="hidden" id="count_" value=0>
        <section class="row mt-2" id="class_count">
          
        </section>


        <div class="col-12" id="add_more_button" style="display: none;">
          <i class="fas fa-plus btn btn-success" onclick="addMore()"></i>
          <button class="btn btn-primary float-end" name="p_report" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
require_once('partials/_scripts.php');
?>

<script>

    let divId = document.getElementById("class_count");
    let countField = document.getElementById("count_");
    let count = parseInt(countField.value);

  function addMore() {    
    let script = document.createElement("script");
    script.innerHTML = 'jQuery(".select-multiple-tag").select2()';
    let countField = document.getElementById("count_");
    let count = parseInt(countField.value);
    let data = `
    <div class="row" id="pr_${count}">
      <div class="col-md-4" >
          <label for="validationCustom04" class="form-label">Subjects</label>
          <select name="class[]" class="form-select select-multiple-tag" id="validationCustom04" required > 
            <option></option>
            <?php foreach($result as $row){   ?>
            <option value="<?php echo $row["id"]; ?>"><?php echo $row["subject_code"] . ' ' . $row["subject_title"] . ' ' . faculty($row['subject_teacher_id'])['name']; ?></option>
            <?php } ?>                  
          </select>
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
                <i class="fas fa-trash btn btn-danger" onclick="remove(${count})"></i>                              
          </div>
      </div>
    </div>
 `;

    //divId.innerHTML+=data
    divId.insertAdjacentHTML('beforeend', data);
    countField.value = count + 1;
    document.head.appendChild(script);
  }

  (function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()



  function remove(did) {
    document.getElementById("pr_" + did).remove();
  }

  function changeDate(){
    
    let _date = document.getElementById("dateInput").value;
    let divId = document.getElementById("class_count");
    const d = new Date(_date);
    let day = d.getDay();
    if(day>0){
      document.getElementById("loader").style.display = "block";
      divId.innerHTML='';
      document.getElementById("add_more_button").style.display = "none";
      $.ajax({
            type: "POST",
            url: 'subjects_dropdown.php',
            data: {
                  week_day: day,                  
                  },
            success: function(response)
            {
              let script = document.createElement("script");
              script.innerHTML = 'jQuery(".select-multiple-tag").select2()';
              let jsonData = JSON.parse(response);
              divId.innerHTML=jsonData.data;
              //divId.insertAdjacentHTML('beforeend', data);
              countField.value = jsonData.count + 1;
              document.head.appendChild(script);
              document.getElementById("loader").style.display = "none";
              document.getElementById("add_more_button").style.display = "block";

              
              //alert(response)
              //divId.insertAdjacentHTML('beforeend', response);
                /*var jsonData = JSON.parse(response);
  
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    location.href = 'my_profile.php';
                }
                else
                {
                    alert('Invalid Credentials!');
                }*/
           }
       });
    }
    else{
      alert("It's Sunday");
    }
    
  }
</script>
</body>

</html>
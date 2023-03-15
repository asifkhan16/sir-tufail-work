<?php
  $student_id = (int) $_GET['student_id'];
  if ($student_id < 1){
    echo "<a href='index.php'>Back to Home</a><br>";
    exit("Invalid Student ID");
  }

  include("processor/get_data_processor.php");
  $resp = "";
  if (isset($_POST['update_student'])){
    $resp = $obj->update_student();
    if ($resp == "ok"){
      header("location: index.php");
    }
  }

  $student_record = $obj->get_single_student($student_id);
  $class_arr = $obj->get_classes();

?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h3>Update Record</h3>
          <form action="update.php?student_id=<?php echo $student_id; ?>" method="post">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="<?php echo $student_record->student_name; ?>">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="<?php echo $student_record->student_email; ?>">
            </div>
            <div class="form-group">
              <label>Contact</label>
              <input type="text" name="contact" class="form-control" value="<?php echo $student_record->student_contact; ?>">
            </div>
            <div class="form-group">
              <label>Reg#</label>
              <input type="text" name="reg_no" class="form-control" value="<?php echo $student_record->reg_no; ?>">
            </div>
            <div class="form-group">
              <label>Class</label>
              <select class="form-control" name="class_id">
                <option value="0">Select Class</option>

                <?php 
                foreach ($class_arr as $key => $value) { 
                  $selected = "";
                  if ($value->class_id == $student_record->class_id){
                    $selected = "selected";
                  }
                  ?>
                  <option value="<?php echo $value->class_id; ?>" <?php echo $selected; ?>><?php echo $value->class_name; ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="form-group">
              <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
              <input type="submit" name="update_student" class="btn btn-success" value="Update">
              <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>

            <div class="form-group">
              <p style="color:red"><?php echo $resp; ?></p>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
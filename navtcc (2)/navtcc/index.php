<?php
include("processor/get_data_processor.php");

$resp = "";
if (isset($_POST['insert_student'])){
  $resp = $obj->add_student();
}

if (isset($_POST['delete_student'])){
  $resp = $obj->delete_student();
}


$students_arr = $obj->get_students();
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
        <div class="col-sm-4">
          <h3>Insert Record</h3>
          <form action="index.php" method="post">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Contact</label>
              <input type="text" name="contact" class="form-control">
            </div>
            <div class="form-group">
              <label>Reg#</label>
              <input type="text" name="reg_no" class="form-control">
            </div>
            <div class="form-group">
              <label>Class</label>
              <select class="form-control" name="class_id">
                <option value="0">Select Class</option>

                <?php foreach ($class_arr as $key => $value) { ?>
                  <option value="<?php echo $value->class_id; ?>"><?php echo $value->class_name; ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="form-group">
              <input type="submit" name="insert_student" class="btn btn-success" value="Insert">
            </div>

            <div class="form-group">
              <p style="color:red"><?php echo $resp; ?></p>
            </div>
          </form>
        </div>
        <div class="col-sm-8">
          <div class="responsive">
            <table class="table table-striped table-hovered table-bordered">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Reg#</th>
                  <th scope="col">Class</th>
                  <th scope="col">Action</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($students_arr as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->student_name; ?></td>
                      <td><?php echo $value->student_email; ?></td>
                      <td><?php echo $value->student_contact; ?></td>
                      <td><?php echo $value->reg_no; ?></td>
                      <td><?php echo $value->class_name; ?></td>
                      <td>
                        <form action="index.php" method="post">
                          <input type="hidden" name="student_id" value="<?php echo $value->student_id; ?>">
                          <input type="submit" name="delete_student" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure want to delete this student?');">
                        </form>
                      </td>
                      <td>
                        <a class="btn btn-primary" href="update.php?student_id=<?php echo $value->student_id; ?>&dummy=text123">Update</a>
                      </td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
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
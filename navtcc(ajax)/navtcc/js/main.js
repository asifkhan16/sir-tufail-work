$(document).ready(function(){

  $(this).on("submit", "#insert_student_form", function(e){
    e.preventDefault();
    var formdata = new FormData(this);
    formdata.append("op","add_student");

    var resp = $("#resp");
    resp.html("Adding Student...");

    $.ajax({ 
      type: 'post',
      url: 'processor/get_data_processor.php',
      data: formdata,
      cache: false,
      contentType: false,
      processData: false,

      success: function (r) {
        if (r == "ok"){
          $("#insert_student_form")[0].reset();
          resp.html("Student Added Successfully");
        }else{
          resp.html(r);
        }
      },

      error: function (e) {
        resp.html("Some error occured. Try later.");
      }

    }); //END OF AJAX;

  }); //END OF CLICK EVENT

  $(this).on("submit", ".delete_student_form", function(e){
    e.preventDefault();
    var formdata = new FormData(this);
    formdata.append("op","delete_student");

    var resp = $("#resp");
    resp.html("Deleting Student...");

    $.ajax({ 
      type: 'post',
      url: 'processor/get_data_processor.php',
      data: formdata,
      cache: false,
      contentType: false,
      processData: false,

      success: function (r) {
        if (r == "ok"){
          load_student_data();
        }
        resp.html(r);
      },

      error: function (e) {
        resp.html("Some error occured. Try later.");
      }

    }); //END OF AJAX;

  }); //END OF CLICK EVENT

}); //END OF READY

function load_student_data(){
  $.ajax({ 
    type: 'post',
    url: 'processor/get_data_processor.php',
    data: {op: "get_students"},
    success: function (r) {
      r = JSON.parse(r);

      var html = "";
      for(i = 0; i< r.length; i++){
        html += '<tr><td>'+(i+1)+'</td><td>'+r[i].student_name+'</td><td>'+r[i].student_email+'</td><td>'+r[i].student_contact+'</td><td>'+r[i].reg_no+'</td><td>'+r[i].class_name+'</td><td><form class="delete_student_form"><input type="hidden" name="student_id" value="'+r[i].student_id+'"><input type="submit" name="delete_student" class="btn btn-danger" value="Delete" onclick=return confirm("Are you sure want to delete this student?");></form></td><td><a class="btn btn-primary" href="update.php?student_id='+r[i].student_id+'&dummy=text123">Update</a></td></tr>';
      }

      $("#show_student_tbody").html(html);

    },

    error: function (e) {
      resp.html("Some error occured. Try later.");
    }

  }); //END OF AJAX;

}
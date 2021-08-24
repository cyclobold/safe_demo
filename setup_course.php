<?php 
if(isset($_GET['cid'])){
	$course_id = (int)$_GET['cid'];

	//get course data
	require "functions/functions.func.php";

	$course_data = getCourseData($course_id);

	$course = null;
	if($course_data['code'] == "success"){
		$course = $course_data['data'];
	}

	// echo "<pre>";
	// print_r($course['course_name']);
	// die('');

}else{


	

}
	

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Safe Demo | Setup Course</title>

    <!-- Bootstrap core CSS -->
    <link href="thirdparties/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="POST" id="create-course-form">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Quick Setup <?=$course['course_name']?> <h1>
      <div class="form-group">
        <label for="inputEmail" class="sr-only">Change Course title</label>
      <input type="text" name="course_name" id="inputEmail" class="form-control" placeholder="Course title" value="<?=$course['course_name']?>" required autofocus>
      </div>

       <div class="form-group">
        <label for="inputEmail" class="sr-only">Change Course code</label>
      <input type="text" name="course_code" id="inputEmail" class="form-control" placeholder="Course code" value="<?=$course['course_code']?>" required autofocus>
      </div>


   <div class="form-group">
        <label for="inputPassword" class="sr-only">Change Course description</label>
      <textarea id="inputPassword" name="course_description" class="form-control" placeholder="Course description" required><?=$course['course_name']?></textarea>
   </div>
  
     <div class="form-group mt-5">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
     </div>

     <hr>

      <div class="form-group mt-5">
        <button type='button' data-target="#createScheduleModal" data-toggle="modal" class="btn btn-sm bg-dark text-light">Create Schedule</button>

        <a href="manage_schedules.php?cid=<?=$course['id']?>" role='button' class="btn btn-sm bg-dark text-light">Manage Schedule</a>
     </div>
 
    </form>


    <!-- Modals -->

<div class="modal fade" id="createScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Schedule for <?=$course['course_name']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	
        <form class="form" method="POST" id="create-schedule-form">
        		
        	<div class="form-group">
        		<input type='text' name='schedule_name' class='form-control' placeholder="Schedule name" required>
        	</div>

        	<div class="form-group">
        		<input type='text' name='schedule_description' class='form-control' placeholder="Schedule description" required>
        	</div>

        	<div class="form-group">
        		<h5>Start date</h5>
        		<input type='date' name='start_date' class='form-control' placeholder="Start date" required>
        	</div>

        	<div class="form-group">
        		<h5>End date</h5>
        		<input type='date' name='end_date' class='form-control' placeholder="End date" required>
        	</div>


        	<div class="form-group">
        		<h5>Start time</h5>
        		<input type='time' name='start_time' class='form-control' placeholder="Start time" required>
        	</div>

        		<div class="form-group">
        		<h5>End time</h5>
        		<input type='time' name='end_time' class='form-control' placeholder="End time" required>
        	</div>

        	<input type='hidden' name='course_id' value="<?=$course['id']?>">

        		<div class="form-group">
        		<button class="btn btn-block btn-secondary">Create Schedule</button>
        		</div>
        </form>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>



    <!-- End of Modals -->
  </body>

  <script type="text/javascript" src="thirdparties/jquery.min.js"></script>
  <script type="text/javascript" src="thirdparties/bootstrap/bootstrap.min.js"></script>


  <script>
  	
  	$("#create-schedule-form").submit(function(e){
  		e.preventDefault();



  		$.post({

  			url: "__lds/__create_course_schedule.php",
  			data: $(this).serialize(),
  			success: function(feedback){
  				feedback = JSON.parse(feedback);

  				if(feedback.code == "success"){

  					$("#createScheduleModal").modal("hide");

  					alert(feedback.message);


  				}
  				

  			}, 
  			beforeSend(){


  			}

  		})


  	})



  </script>


</html>

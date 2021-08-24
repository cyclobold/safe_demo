<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Safe Demo | Create Course</title>

    <!-- Bootstrap core CSS -->
    <link href="thirdparties/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="POST" id="create-course-form">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Create course</h1>
      <div class="form-group">
        <label for="inputEmail" class="sr-only">Course title</label>
      <input type="text" name="course_name" id="inputEmail" class="form-control" placeholder="Course title" required autofocus>
      </div>


   <div class="form-group">
        <label for="inputPassword" class="sr-only">Course description</label>
      <textarea id="inputPassword" name="course_description" class="form-control" placeholder="Course description" required></textarea>
   </div>
  
     <div class="form-group mt-5">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Create and Setup</button>
     </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>

  <script type="text/javascript" src="thirdparties/jquery.min.js"></script>


<script>
  
  //When you click "Submit"
  $("#create-course-form").submit(function(e){
    e.preventDefault();

    $.post({

      url: "__lds/__inc.create-course.php",
      data: $(this).serialize(),
      success: function(feedback){
        feedback = JSON.parse(feedback);
        if(feedback.code == 'success'){
            //console.log(feedback);
            location.href=`/setup_course.php?cid=${feedback.data.course_id}`

        }
      },
      beforeSend(){

      }

    })
    

  })



</script>

</html>

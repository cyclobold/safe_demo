<?php
  if(isset($_GET['cid'])){

      $course_id = $_GET['cid'];
      require "functions/functions.func.php";
      //get course schedules
      $schedules_info = getCourseSchedules($course_id);


      $schedules = $schedules_info['data'];




      // echo count($schedules);

      // die("");

      // foreach($schedules['data'] as $schedule_key){

      //         echo "<pre>";
      //         print_r($schedule_key);

      // }
      //  die("");
  }

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Safe | Manage Schedules</title>

    <!-- Bootstrap core CSS -->
<link href="thirdparties/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">SAFE</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <?php require "includes/side-bar.php"; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Schedules</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">

                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
           
            </div>
          </div>


          <h2>Schedules</h2>
          <div class="table-responsive">
              
              <?php 
                if(count($schedules) == 0){

                    echo "  <div class='alert alert-info'>
                            No course schedule created yet
                          </div>
                          ";

                }else{

                  echo " <table class='table table-striped table-sm'>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Course name</th>
                          <th>Schedule id</th>
                          <th>Schedule name</th>
                          <th>Schedule description</th>
                          <th>Start date</th>
                          <th>End date</th>
                        </tr>
                      </thead>
                      <tbody>";


                      foreach($schedules as $schedule){

                          echo " <tr>
                                  <td>{$schedule['course_id']}</td>
                                   <td>{$schedule['course_name']}</td>
                                    <td>{$schedule['schedule_id']}</td>
                                  <td>{$schedule['schedule_name']}</td>
                                  <td>{$schedule['schedule_description']}</td>
                                  <td>{$schedule['start_date']}</td>
                                  <td>{$schedule['end_date']}</td>
                              </tr>";

                      }



                echo " </tbody>
                    </table>";



                }

              ?>

          </div>
        </main>
      </div>
    </div>

  
    <script type="text/javascript" src="thirdparties/jquery.min.js"></script>
  <script type="text/javascript" src="thirdparties/bootstrap/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>


    <script>
    
    </script>
  </body>
</html>

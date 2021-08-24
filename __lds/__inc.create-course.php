<?php
require "../functions/functions.func.php";
if(isset($_POST['course_name']) && isset($_POST['course_description'])){


$course_name = trim($_POST['course_name']);
$course_description = trim($_POST['course_description']);



//call a function
$result = createCourse($course_name, $course_description);


 echo json_encode($result);




}







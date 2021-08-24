<?php
require "../functions/functions.func.php";

$params = $_POST;
$course_id = $_POST['course_id'];
$result = createCourseSchedule($course_id, $params);

echo json_encode($result);


<?php

/**
 * Creates a new course
 * @return array containing course information
 */
function createCourse($course_name, $course_description){

	require "../database/__connect.db.php";



	//check if this course exists already
	$result = checkCourseExists($course_name);

	if($result['code'] == 'error'){
		return $result;
	}else{

		$course_name_lower = strtolower($course_name);
		//create the course
		$query = "INSERT INTO `courses` (`course_name`, `course_description`, `course_name_lower`) VALUES('$course_name', '$course_description', '$course_name_lower')";

		$result = mysqli_query($__conn, $query);

		if($result){

			//the table has been created..
			//create the schedule table for the course
			
			/**
			 * - course id
			 * - schedule name
			 * - schedule description
			 * - students enrolled
			 * - start_date
			 * - end_date
			 * - start_time
			 * - end_time
			 * 
			 */
			
			$last_course_id = mysqli_insert_id($__conn);

			$schedule_table = "course_".$last_course_id."_schedules";


			$create_table_query = "CREATE TABLE IF NOT EXISTS `$schedule_table`(

					id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
					course_id INT NOT NULL,
					schedule_name VARCHAR(64) NOT NULL,
					schedule_description TEXT(5000) NOT NULL,
					students_enrolled INT DEFAULT(0),
					start_date VARCHAR(100) NOT NULL,
					end_date VARCHAR(100) NOT NULL,
					start_time VARCHAR(100) NOT NULL,
					end_time VARCHAR(100) NOT NULL

			)";

			$create_sch_result = mysqli_query($__conn, $create_table_query);


			if($create_sch_result){

				return [

						'message' => "Course created succesfully",
						'data' => [

							'course_id' => $last_course_id,
							'course_name' => $course_name

						],
						"code" => "success"



				];

			}







		}else{

			//error.. the query failed
			return [

						'message' => "Error: ".mysqli_error($__conn),
						'data' => [],
						"code" => "error"



				];
		}


	}



}


function checkCourseExists($course_name){

	require "../database/__connect.db.php";


	$course_name = strtolower($course_name);

	$query = "SELECT * FROM `courses` WHERE `course_name_lower` = '$course_name' LIMIT 1";

	$result = mysqli_query($__conn, $query);

	if($result){

		if(mysqli_num_rows($result) == 1){
			//there is a match
			//there is no match
			return [
				'message' => true,
				'data' => [],
				'code' => 'success'
			];
		}else{
			//there is no match
			return [
				'message' => false,
				'data' => [],
				'code' => 'success'
			];

		
	}



}else{
	//the query did not run
			return [
				'message' => mysqli_error($__conn),
				'data' => [],
				'code' => 'error'
			];
}

}


function getCourseData($course_id){
	require "database/__connect.db.php";

	$query = "SELECT * FROM `courses` WHERE `id` = $course_id LIMIT 1";
	$result = mysqli_query($__conn, $query);

	if($result){

		if(mysqli_num_rows($result) == 1){

			$course = mysqli_fetch_array($result, MYSQLI_ASSOC);

			return [

				"data" => $course,
				"message" => "Course available",
				"code" => "success",
				"status" => 201
			];

		}else{

			return [

				"data" => [],
				"message" => "Course not available",
				"code" => "error",
				"status"  => 404

				];


		}


	}else{


		return [

				"data" => [],
				"message" => "Error: ".mysqli_error($__conn),
				"code" => "error",
				"status"  => 500

				];



	}



}	


function createCourseSchedule($course_id, $params){
	require "../database/__connect.db.php";
	//trim this before usage
	//also, check if set with isset
	$schedule_name = $params['schedule_name'];
	$schedule_desc =$params['schedule_description'];
	$start_date = $params['start_date'];
	$end_date = $params['end_date'];
	$start_time = $params['start_time'];
	$end_time = $params['end_time'];

	$course_id = $params['course_id'];


	$schedule_table = "course_".$course_id."_schedules";



	$create_query = "INSERT INTO `$schedule_table` (
						`course_id`, 
						`schedule_name`, 
						`schedule_description`,
						`start_date`,
						`end_date`,
						`start_time`,
						`end_time`
						)
						VALUES(
							$course_id,
							'$schedule_name',
							'$schedule_desc',
							'$start_date',
							'$end_date',
							'$start_time',
							'$end_time'
						)
						";


	$create_result = mysqli_query($__conn, $create_query);

	if($create_result){

		return [

			"message" => "Schedule created",
			"data" => [], 
			"code" => "success"

		];


	}else{

		return [

			"message" => "Error: ".mysqli_error($__conn),
			"data" => [], 
			"code" => "error"

		];



	}






}


function getCourseSchedules($course_id){
	require "database/__connect.db.php";

	$course_schedules = "course_".$course_id."_schedules";


	//link two tables
	$query = "SELECT `courses`.id AS `course_id`, `courses`.course_name, `courses`.course_description, `$course_schedules`.* FROM `courses` INNER JOIN `$course_schedules` ON `courses`.id = `$course_schedules`.course_id";


	$result = mysqli_query($__conn, $query);



	if($result){

		$course_schedule_results = [];
		while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){

			$schedules = [];

			$schedules['course_id'] =  $rows['course_id'];
			$schedules['course_name'] = $rows['course_name'];
			$schedules['schedule_name'] = $rows['schedule_name'];
			$schedules['schedule_description'] = $rows['schedule_description'];
			$schedules['start_date'] = $rows['start_date'];
			$schedules['end_date'] = $rows['end_date'];
			$schedules['start_time'] = $rows['start_time'];
			$schedules['end_time'] = $rows['end_time'];
			$schedules['schedule_id'] = $rows['id'];

			$course_schedule_results[] = $schedules;
		}


		return [

			"data" => $course_schedule_results,
			"code" => "success",
			"status" => 201,
			"message" => "Successful"

		];


	}else{

		return [

			"data" => [],
			"code" => "error",
			"status" => 500,
			"message" => "Error: ".mysqli_error($__conn)

		];

	}





}


function getAllCourses($param = null){
	require "database/__connect.db.php";

	if($param == "id"){
		$query = "SELECT id FROM `courses`";
	}	

	

	$result = mysqli_query($__conn, $query);

	if($result){
		$courses_ids = [];
		while($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)){

				$courses_ids[] = $rows['id'];

		}

		return [

			"data" => $courses_ids,
			"message" => "Successful",
			"code" =>  "success",
			"status" => 201

		];

	}else{

		return [

			"data" => [],
			"message" => "Error: ".mysqli_error($conn),
			"code" =>  "error",
			"status" => 500

		];


	}
}


function getAllSchedules(){
	require "database/__connect.db.php";


	//get all courses..
	$courses = getAllCourses('id')['data'];

	$schedules = [];
	foreach($courses as $course_id){

		//get the schedules..
		$course_schedules = getCourseSchedules($course_id)['data'];

		$schedules[] = $course_schedules;
	}

	$all_schedules= [];
	for($i = 0; $i < count($schedules); $i++){

		$all_schedules = array_merge($all_schedules, $schedules[$i]);

	}


	// echo "<pre>";
	// print_r($all_schedules);
	// die("");

	return $all_schedules;

}



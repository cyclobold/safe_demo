<?php
$allowed_fields = ['course_name', 'course_description'];
$activate = [];
$form_data = [];
foreach($_POST as $key => $value){

	if(isset($_POST[$key])){
		$activate[] = 'yes'; 

		$form_data[$key] = trim($_POST[$key]);

	}else{
		$activate[] = "no";
	}
}


echo json_encode($form_data);








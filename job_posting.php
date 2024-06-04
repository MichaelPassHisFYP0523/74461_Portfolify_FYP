<?php

include ("con.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['job_title'];
    $jobType = $_POST['jobType'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $requirement = $_POST['requirement'];

    $user_id = $_POST['user_id'];


    $sql = "INSERT INTO `job`(
        `job_id`,
        `job_title`,
        `job_location`,
        `salary`,
        `requirement`,
        `job_types`,
        `recruiter_id`
    ) VALUES (?, ?, ?, ?, ?, ?, ?)";
}

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $new_id, $title, $location, $salary, $requirement,$user_id);

?>
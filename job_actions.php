<?php
include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    switch ($action) {
        case 'delete';
            $job_id = $_POST['job_id'];

                // Validate the job_id and user ownership
                $query = "SELECT * FROM job WHERE job_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $job_id);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if ($result->num_rows > 0) {
                    
                    $delete_query = "DELETE FROM job WHERE job_id = ?";
                    $delete_stmt = $conn->prepare($delete_query);
                    $delete_stmt->bind_param("s", $job_id);
    
                    if ($delete_stmt->execute()) {
                        echo 'success';
                    } else {
                        echo 'Error: ' . $delete_stmt->error;
                    }
                    $delete_stmt->close();
                } else {
                    echo 'Error: Project not found or you do not have permission to delete this project.';
                }
    
                $stmt->close();
                break;

        case 'upload':

            $title = $_POST['job_title'];
            $jobType = $_POST['jobType'];
            $location = $_POST['location'];
            $salary = $_POST['salary'];
            $requirement = $_POST['job_requirements'];
            $desc = $_POST['job_description'];
            $user_id = $_POST['user_id'];

            $new_id = uniqid('job_', true);

            $sql = "INSERT INTO `job` (
                `job_id`,
                `job_title`,
                `job_desc`,
                `job_location`,
                `salary`,
                `requirement`,
                `job_types`,
                `recruiter_id`
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ssssssss", $new_id, $title, $desc, $location, $salary, $requirement, $jobType, $user_id);

            if ($stmt->execute()) {
                echo "New job created successfully";
            } else {
                echo "Error creating job: " . $stmt->error;
            }
            $stmt->close();

            break;
        
        case 'edit':

            $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);
            $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
            $job_location = mysqli_real_escape_string($conn, $_POST['job_location']);
            $salary = mysqli_real_escape_string($conn, $_POST['salary']);
            $job_types = mysqli_real_escape_string($conn, $_POST['job_types']);
            $job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
            $job_requirements = mysqli_real_escape_string($conn, $_POST['job_requirements']);

            $query = "UPDATE `job` SET 
                    `job_title` = ?, 
                    `job_desc` = ?, 
                    `job_location` = ?, 
                    `salary` = ?, 
                    `requirement` = ?, 
                    `job_types` = ? 
                    WHERE `job_id` = ?";

            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, 'sssssss', $job_title, $job_description, $job_location, $salary, $job_requirements, $job_types, $job_id);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
            echo 'Job updated successfully!';
            } else {
            echo 'Error updating job: ' . mysqli_stmt_error($stmt);
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
            } else {
            echo 'Error preparing statement: ' . mysqli_error($conn);
            }

            break;
    }

} else {
    echo 'Invalid request method.';
}
?>
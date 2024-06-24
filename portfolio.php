<?php

include 'auth.php';
include("con.php");

// Get the sender ID from the URL parameter
if(isset($_GET['id'])) {
    $sender_id = $_GET['id'];
} else {
    echo "Sender ID not provided.";
    exit();
}

// Fetch the user role
$sql = "SELECT `role` FROM `users` WHERE `User_ID` = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $sender_id);
    $stmt->execute();
    $stmt->bind_result($user_role);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Error fetching user role: " . $conn->error;
    exit();
}

// Fetch profile data based on user role
if ($user_role == 'recruiter') {
    $sql = "SELECT * FROM `recruiter_profile` WHERE `User_ID` = ?";
} else {
    $sql = "SELECT * FROM `user_profile` WHERE `User_ID` = ?";
}

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $sender_id);
    $stmt->execute();
    $profile_data = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Increment the profile view count
    if ($user_role == 'recruiter') {
        $view_count_sql = "UPDATE `recruiter_profile` SET profileView = profileView + 1 WHERE User_ID = ?";
    } else {
        $view_count_sql = "UPDATE `user_profile` SET profile_views = profile_views + 1 WHERE User_ID = ?";
    }

    if ($update_stmt = $conn->prepare($view_count_sql)) {
        $update_stmt->bind_param("s", $sender_id);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        echo "Error updating profile views: " . $conn->error;
        exit();
    }
} else {
    echo "Error fetching profile data: " . $conn->error;
    exit();
}
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Portfolify</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/owl.carousel.min.css" rel="stylesheet">
        <link href="css/owl.theme.default.min.css" rel="stylesheet">
        <link href="css/tooplate-gotto-job.css" rel="stylesheet">


    </head>
    
    <body class="about-page" id="top">
        <?php include 'navbar.php'; ?>
        <main>
            <section class="about-section">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-12 mt-5 mt-lg-0">
                        <h2>View profile</h2>
                        <div class="about-image-wrap">
                            <?php if ($user_role == 'recruiter'): ?>
                                <img src="<?php echo $profile_data['logo']; ?>"  alt="">
                            <?php else: ?>
                                <img src="<?php echo $profile_data['ProfilePicture']; ?>"  alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                        <div class="col-lg-5 col-12">
                            <div class="about-info-text">
                            <?php if ($user_role == 'recruiter'): ?>
                                <h2 class="mb-0"><?php echo $profile_data['company_name']; ?></h2>
                                <h4 class="mb-2">About Us</h4>
                                <p><?php echo $profile_data['about']; ?></p>
                                <p><strong>Contact Email:</strong> <a href="mailto:<?php echo $profile_data['contact_email']; ?>"><?php echo $profile_data['contact_email']; ?></a></p>
                                <p><strong>Contact Phone:</strong> <?php echo $profile_data['contact_phone']; ?></p>
                                <p><strong>Website:</strong> <a href="<?php echo $profile_data['website']; ?>" target="_blank"><?php echo $profile_data['website']; ?></a></p>
                                <p><strong>Company background:</strong> <?php echo $profile_data['background']; ?></p>
                            <?php else: ?>
                                <h2 class="mb-0"><?php echo $profile_data['FirstName'] . " " . $profile_data['Lastname']; ?></h2>
                                <h4 class="mb-2">Profile</h4>
                                <p><strong>Contact Email:</strong> <a href="mailto:<?php echo $profile_data['email']; ?>"><?php echo $profile_data['email']; ?></a></p>
                                <p><strong>Gender:</strong> <?php echo $profile_data['Gender']; ?></p>
                                <p><strong>Bio:</strong> <?php echo $profile_data['Bio']; ?></p>
                                <p><strong>Social Media Links:</strong> <?php echo $profile_data['SocialMediaLinks']; ?></p>
                                <p><strong>Education:</strong> <?php echo $profile_data['Education']; ?></p>
                                <p><strong>Experience:</strong> <?php echo $profile_data['Experience']; ?></p>
                            <?php endif; ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>

            <!-- Job Section (Visible only to recruiters) -->
            <?php if ($role === 'recruiter'): ?>
                <section class="projects-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <h2>Job Available</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // Fetch projects associated with the user
                        $job_query = "SELECT * FROM job WHERE recruiter_id = '$user_id'";
                        $job_result = $conn->query($job_query);

                        if ($job_result->num_rows > 0) {
                            while ($job_row = $job_result->fetch_assoc()) {
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <a href="job-detail.php?id=<?php echo $job_row['job_id']; ?>">
                                    <div class="card h-100"> 
                                        
                                        <div class="card-body d-flex flex-column"> 
                                            <h5 class="card-title"><?php echo $job_row['job_title']; ?></h5>
                                            <p class="card-text flex-grow-1"><?php echo $job_row['date_posted']; ?>
                                            <?php echo $job_row['job_location']; ?>
                                            <?php echo $job_row['job_types']; ?></p> 
                                        </div>
                                    </div>
                                </a>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-lg-12 col-12 text-center">
                                <p>No job found.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <!-- Projects Section -->
            <section class="projects-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <h2>My Projects</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // Fetch projects associated with the user
                        $project_query = "SELECT * FROM projects WHERE `user_id` = '$sender_id'";
                        $project_result = $conn->query($project_query);

                        if ($project_result->num_rows > 0) {
                            while ($project_row = $project_result->fetch_assoc()) {
                                ?>
                                
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <a href="project-detail.php?id=<?php echo $project_row['project_id']; ?>">
                                        <div class="card h-100"> 
                                            <img src="<?php echo $project_row['project_image']; ?>" class="card-img-top" alt="Project Image">
                                            <div class="card-body d-flex flex-column"> 
                                                <h5 class="card-title"><?php echo $project_row['title']; ?></h5>
                                                <p class="card-text flex-grow-1"><?php echo $project_row['description']; ?></p> 
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-lg-12 col-12 text-center">
                                <p>No projects found.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    
                </div>
            </section>

        </main>

        <?php include("footer.php"); ?>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>

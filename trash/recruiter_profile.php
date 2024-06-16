<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: Sign_In.php");
        exit();
    }

    include 'con.php';

    $email = $_SESSION['email'];

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT users.*, recruiter_profile.* FROM users
            INNER JOIN recruiter_profile ON users.User_ID = recruiter_profile.User_ID
            WHERE users.email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

    } else {
        // echo "User not found!";
        session_destroy();
        header("Location: Sign_In.php");
        
    }

?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolify Recruiter Profile</title>

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
    
    <body id="top">

        <!-- Navigation Bar -->
        <?php include 'navbar_recruiter.php'; ?>
        <!-- End Navbar -->

        <main>

        <header class="site-header">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">Company profile</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- Profile Overview -->
        <section class="contact-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-12 mb-lg-5 mb-3 text-center">
                        <img src="<?php echo $row['logo'] ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3 mx-auto" style="width: 150px; height: 150px;">
                        <h4><?php echo $row['company_name'] ?></h4>
                        <h5><?php echo $row['about'] ?></h5>
                        <button class="custom-btn btn" onclick="window.location.href='edit_recruiter.php'">Edit Profile</button>
                    </div>

                    <div class="col-lg-5 col-12 mb-3 mx-auto">
                        <div class="profile-analytics-wrap">
                            <div class="profile-analytics d-flex align-items-center mb-3">
                                <i class="custom-icon bi-graph-up"></i>
                                <p class="mb-0">
                                    <span class="profile-analytics-small-title">Profile Views</span>
                                    <?php echo $row['profile_views'] ?>
                                </p>
                            </div>

                            <div class="profile-analytics d-flex align-items-center mb-3">
                                <i class="custom-icon bi-calendar-event"></i>
                                <p class="mb-0">
                                    <span class="profile-analytics-small-title">Last Active</span>
                                    <?php echo $row['LastActive'] ?>
                                </p>
                            </div>

                            <div class="profile-analytics d-flex align-items-center mb-3">
                                <i class="custom-icon bi-person-check"></i>
                                <p class="mb-0">
                                    <span class="profile-analytics-small-title">Followers</span>
                                    <?php echo $row['Followers'] ?>
                                </p>
                            </div>

                            <div class="profile-analytics d-flex align-items-center">
                                <i class="custom-icon bi-envelope"></i>
                                <p class="mb-0">
                                    <span class="profile-analytics-small-title">Messages Received</span>
                                    <?php echo $row['MessagesReceived'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Projects Section -->
        <section class="projects-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h2>My Projects</h2>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-12 col-12 text-center">
                        <a href="project_manage.php" class="btn btn-secondary mr-2">Manage Projects</a>
                        <a href="#upload-section" class="btn btn-primary">Add Project</a>
                    </div>
                </div>
                <div class="row">
                    <?php
                    // Fetch projects associated with the user
                    $project_query = "SELECT * FROM projects WHERE `user_id` = '$user_id'";
                    $project_result = $conn->query($project_query);

                    if ($project_result->num_rows > 0) {
                        while ($project_row = $project_result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100"> 
                                    <img src="<?php echo $project_row['project_image']; ?>" class="card-img-top project-image" alt="Project Image">
                                    <div class="card-body d-flex flex-column"> 
                                        <h5 class="card-title"><?php echo $project_row['title']; ?></h5>
                                        <p class="card-text flex-grow-1"><?php echo $project_row['description']; ?></p> 
                                    </div>
                                </div>
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
            </div>
        </section>

        <!-- Post a Job -->
        <section style="margin-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">

                    <!-- Display success or error message -->
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['success_message'];
                            unset($_SESSION['success_message']);
                            ?>
                        </div>
                    <?php elseif (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['error_message'];
                            unset($_SESSION['error_message']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <form class="custom-form contact-form" action="job_posting.php" method="post" role="form" enctype="multipart/form-data">
                        <h2 class="text-center mb-4">Post a job</h2>

                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <label for="job_title">Title</label>
                                <input type="text" name="job_title" id="job_title" class="form-control" placeholder="Eg. Project manager" required>
                            </div>

                            <div class="col-lg-12 col-12">
                                <label class="col-lg-12 col-12" for="jobType">Types</label>
                                <select name="jobType" id="jobType" class="form-control">
                                    <option value="" disabled selected>Select a job type</option>
                                    <option value="Part Time">Part-Time</option>
                                    <option value="Full Time">Full-Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Intern">Internship</option>
                                </select>

                            </div>

                            <div class="col-lg-12 col-12">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" rows="6" class="form-control" placeholder="Kuching, Malaysia" required>
                            </div>

                            <div class="col-lg-12 col-12">
                                <label for="salary">Salary</label>
                                <input type="text" name="salary" id="salary" rows="6" class="form-control" placeholder="2k - 4k" required>
                            </div>

                            <div class="col-lg-12 col-12">
                                <label for="requirement">Requirement</label>
                                <textarea name="requirement" id="desc" rows="6" class="form-control" placeholder="Describe your requirement for this position" required></textarea>
                            </div>

                            <!-- Hidden input field to store the user_id -->
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                            <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                <button type="submit" class="form-control">Post</button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-5"></div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Upload project -->
        <section id="upload-section" class="cta-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <form class="custom-form contact-form" id="uploadForm" method="post" enctype="multipart/form-data">
                            <h2 class="text-center mb-4">Upload your project</h2>

                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <label for="full-name">Title</label>
                                    <input type="text" name="full_name" id="full-name" class="form-control" placeholder="Development of ..." required >
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="file">Upload your file</label>
                                    <input type="file" name="file" id="file" class="form-control" required data-toggle="tooltip" title="Upload the main file of your project">
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="desc">Describe your project</label>
                                    <textarea name="description" id="desc" rows="6" class="form-control" placeholder="This project is about ..." required></textarea>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="image_file">Project image (Optional)</label>
                                    <input type="file" name="image_file" id="image_file" class="form-control" accept="image/*" data-toggle="tooltip" title="Upload an optional image related to your project">
                                </div>

                                <!-- Hidden input field to store the user_id -->
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                <!-- Collaboration preference -->
                                <div class="col-lg-12 col-12">
                                    <label>Collaborate?</label><br>
                                    <input type="radio" name="collaborate" value="1" id="collaborate-yes" required data-toggle="tooltip" title="Select 'Yes' if you are open to collaboration">
                                    <label for="collaborate-yes">Yes</label>
                                    <input type="radio" name="collaborate" value="0" id="collaborate-no" data-toggle="tooltip" title="Select 'No' if you do not want to collaborate">
                                    <label for="collaborate-no">No</label>
                                </div>

                                <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                    <button type="button" onclick="uploadProject()" class="form-control" >Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Upload Job Section (Visible only to recruiters) -->
        <?php if ($role === 'recruiter'): ?>
        <section id="upload-section" class="cta-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <form class="custom-form contact-form" id="uploadForm" method="post" enctype="multipart/form-data">
                            <h2 class="text-center mb-4">Post a Job</h2>

                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <label for="job-title">Job Title</label>
                                    <input type="text" name="job_title" id="job-title" class="form-control" placeholder="Job Title" required >
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="job-description">Job Description</label>
                                    <textarea name="job_description" id="job-description" rows="6" class="form-control" placeholder="Job Description" required></textarea>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="job-requirements">Job Requirements</label>
                                    <textarea name="job_requirements" id="job-requirements" rows="6" class="form-control" placeholder="Job Requirements" required></textarea>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="company-logo">Company Logo (Optional)</label>
                                    <input type="file" name="company_logo" id="company-logo" class="form-control" accept="image/*" data-toggle="tooltip" title="Upload an optional image related to the job">
                                </div>

                                <!-- Hidden input field to store the user_id -->
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                    <button type="submit" class="form-control">Post Job</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        </main>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-12 d-flex align-items-center">

                            <ul class="footer-menu d-flex">
                                <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy Policy</a></li>

                                <li class="footer-menu-item"><a href="#" class="footer-menu-link">Terms</a></li>
                            </ul>
                        </div>
                        <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>

                    </div>
                </div>
            </div>
        </footer>
        <!-- End footer -->

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>
        
        <script>
            function uploadProject() {
                // Get form data
                var formData = new FormData(document.getElementById('uploadForm'));

                // Send an AJAX request to the server-side script
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "upload_project.php", true);
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        // Handle the response from the server
                        alert(xhr.responseText);
                        // You can also update the UI as needed
                    }
                };
                xhr.send(formData);
            }

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

        </script>

        

    </body>
</html>

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

        <title>Portfolify Profile</title>

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
        <?php include 'navbar.php'; ?>
        <!-- End Navbar -->

        <main>

            <header class="site-header">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-12 col-12 text-center">
                            <h1 class="text-white">My profile</h1>

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
                            <h5><?php echo $row['company_name'] ?></h5>
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

                                <div class="profile-analytics d-flex align-items-center">
                                    <i class="custom-icon bi-calendar-event"></i>

                                    <p class="mb-0">
                                        <span class="profile-analytics-small-title">Last Active</span>
                                        <?php echo $row['LastActive'] ?>
                                    </p>
                                </div>

                                <div class="profile-analytics d-flex align-items-center">
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
                                    $project_query = "SELECT * FROM projects WHERE `user_id` = '$user_id' AND proj_status = 1";
                                    $project_result = $conn->query($project_query);

                                    if ($project_result->num_rows > 0) {
                                        while ($project_row = $project_result->fetch_assoc()) {
                                            ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                                <div class="card h-100"> 
                                                    <img src="<?php echo $project_row['project_image']; ?>" class="card-img-top" alt="Project Image">
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
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                        <form class="custom-form contact-form" action="job_posting.php" method="post" role="form" enctype="multipart/form-data">
                            <h2 class="text-center mb-4">Post a job</h2>

                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <label for="job_title">Title</label>
                                    <input type="text" name="job_title" id="job_title" class="form-control" placeholder="Eg. Project manager" required>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="desc">Types</label>
                                    <textarea name="jobType" id="jobType" rows="6" class="form-control" placeholder="What can we help you?" required></textarea>
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

                                <label class="col-lg-12 col-12" for="jobType">Choose a job type:</label>
                                    <select name="jobType" id="jobType">
                                        <option value="partTime">Part-Time</option>
                                        <option value="fullTime">Full-Time</option>
                                        <option value="contract">Contract</option>
                                        <option value="intern">Internship</option>
                                    </select>

                                <!-- Hidden input field to store the user_id -->
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                    <button type="submit" class="form-control">Upload</button>
                                </div>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            <section>

            <div></div>

            <!-- Upload project -->
            <section class="cta-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                        <form class="custom-form contact-form" action="upload.php" method="post" role="form" enctype="multipart/form-data">
                            <h2 class="text-center mb-4">Upload your project</h2>

                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <label for="full-name">Title</label>
                                    <input type="text" name="full_name" id="full-name" class="form-control" placeholder="Jack Doe" required>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="file">Upload your file</label>
                                    <input type="file" name="file" id="file" class="form-control" required>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <label for="desc">Describe your project</label>
                                    <textarea name="description" id="desc" rows="6" class="form-control" placeholder="What can we help you?" required></textarea>
                                </div>

                                <!-- Hidden input field to store the user_id -->
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                    <button type="submit" class="form-control">Upload</button>
                                </div>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            <section>

                    </div>
                </div>
            </section>
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

    </body>
</html>

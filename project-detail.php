<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: Sign_In.php");
        exit();
    }

    include "con.php";

    function getUserByEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT user_id, role FROM users WHERE email = ? LIMIT 1");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }

        $stmt->close();
    }

    function getUserProfileById($conn, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM user_profile WHERE User_ID = ? LIMIT 1");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }

        $stmt->close();
    }

    function getRecruiterProfileById($conn, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM recruiter_profile WHERE User_ID = ? LIMIT 1");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }

        $stmt->close();
    }

    $project = null;
    $user_profile = null;

    if (isset($_GET['id'])) {
        $project_id = $_GET['id'];

        $email = $_SESSION['email'];

        $user = getUserByEmail($conn, $email);
        if ($user === null) {
            die("User not found for email: " . htmlspecialchars($email));
        }

        $user_id = $user['user_id'];
        $role = $user['role'];

        // Fetch the project details
        $stmt = $conn->prepare("SELECT * FROM `projects` WHERE `project_id` = ? LIMIT 1");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $project = $result->fetch_assoc();
        } else {
            die("No project found with the given ID.");
        }

        $stmt->close();

        // Fetch the appropriate user profile details
        if ($role === 'user') {
            $user_profile = getUserProfileById($conn, $user_id);
        } else if ($role === 'recruiter') {
            $user_profile = getRecruiterProfileById($conn, $user_id);
        }

        if ($user_profile === null) {
            die("Profile not found for user_id: " . htmlspecialchars($user_id));
        }

        $conn->close();
    } else {
        die("No project ID provided.");
    }
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Projects Details</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/owl.carousel.min.css" rel="stylesheet">

        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <link href="css/tooplate-gotto-job.css" rel="stylesheet">
        
<!--

Tooplate 2134 Gotto Job

https://www.tooplate.com/view/2134-gotto-job

Bootstrap 5 HTML CSS Template

-->
    </head>
    
    <body id="top">

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="index.html">
                    <img src="images/logo.png" class="img-fluid logo-image">

                    <div class="d-flex flex-column">
                        <strong class="logo-text">Gotto</strong>
                        <small class="logo-slogan">Online Job Portal</small>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-center ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Homepage</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About Gotto</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="job-listings.html">Job Listings</a></li>

                                <li><a class="dropdown-item active" href="job-details.html">Job Details</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>

                        <li class="nav-item ms-lg-auto">
                            <a class="nav-link" href="#">Register</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link custom-btn btn" href="#">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>

            <section class="job-section section-padding pb-0">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12">
                            <h2 class="job-title mb-0"><?php echo htmlspecialchars($project['title']); ?></h2>

                            <div class="job-thumb job-thumb-detail">
                                <div class="d-flex flex-wrap align-items-center border-bottom pt-lg-3 pt-2 pb-3 mb-4">
                                </div>

                                <h4 class="mt-4 mb-2">Project Description</h4>

                                <p><?php echo htmlspecialchars($project['description']); ?></p>

                                <h5 class="mt-4 mb-3">More Information</h5>

                                <a href="<?php echo htmlspecialchars($project['project_path']); ?>" target="_blank" >Download Project Details</a>
                                </div>

                                <div>

                                <div class="d-flex justify-content-center flex-wrap mt-5 border-top pt-4">
                                    <form id="applyForm" class="d-flex flex-column align-items-center w-100">
                                        <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($project['project_id']); ?>">
                                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                                        <button type="submit" class="custom-btn btn mt-2">Request Collaborate</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-12 mt-5 mt-lg-0">
                                <div class="job-thumb job-thumb-detail-box bg-white shadow-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mb-3">
                                            <img src="<?php echo htmlspecialchars($user_profile['ProfilePicture']); ?>" class="job-image me-3 img-fluid" alt="">
                                            <p class="mb-0"><?php echo htmlspecialchars($user_profile['FirstName']); ?></p>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-2">About the author</h6>

                                    <p><?php echo htmlspecialchars($user_profile['Bio']); ?></p>

                                    <h6 class="mt-4 mb-3">Contact Information</h6>

                                    <p class="mb-2">
                                        <i class="custom-icon bi-globe me-1"></i>

                                        <a href="#" class="site-footer-link">
                                            <?php echo htmlspecialchars($user_profile['SocialMediaLinks']); ?>
                                        </a>
                                    </p>

                                    <p>
                                        <i class="custom-icon bi-envelope me-1"></i>

                                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                            <?php echo htmlspecialchars($user_profile['email']); ?>
                                        </a>
                                    </p>
                                </div>
                        </div>
                        </div>

                        
                    </div>
                </div>
            </section>

            <section class="job-section section-padding">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-12 mb-lg-4">
                            <h3>Feature Project</h3>
                        </div>

                        <div class="col-lg-4 col-12 d-flex ms-auto mb-5 mb-lg-4">
                            <a href="job-listings.html" class="custom-btn custom-border-btn btn ms-lg-auto">Browse Job Listings</a>
                        </div>

                        <?php
                            include "con.php";

                            $query = "SELECT * FROM `projects` WHERE `proj_status` = 1 ORDER BY `created_at` DESC LIMIT 3";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="job-thumb job-thumb-box">
                                    
                                    <div class="job-image-box-wrap">
                                        <img src="<?php echo $row['project_image']; ?>" class="job-image img-fluid" alt="job image">
                                    </div>

                                    <div class="job-body">
                                        <h4 class="job-title">
                                            <a href="project-detail.php?id=<?php echo $row['project_id']; ?>" class="job-title-link"><?php echo $row['title']; ?></a>
                                        </h4>

                                        <div class="job-details">
                                        <p><?php echo $row['description']; ?></p>
                                        <p>Price: $<?php echo $row['project_price']; ?></p>
                                    </div>

                                        <p></p>
                                        <div class="action-flex align-items-center border-top pt-3n-buttons">
                                            <p></p>
                                            <a href="project-detail.php?id=<?php echo $row['project_id']; ?>" class="custom-btn btn ms-auto">Collaborate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                            }
                        } else {
                            // If no projects found
                            echo "No projects found";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </main>

        <?php include "footer.php"; ?>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

        <!-- Bootstrap Notify -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-notify@latest/dist/bootstrap-notify.min.js"></script>

        <script>
        document.getElementById('applyForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            
            var formData = new FormData(this); 
            
            $.ajax({
                type: "POST", 
                url: "apply_project.php", 
                data: formData, 
                dataType: "json", 
                processData: false, 
                contentType: false, 
                success: function(response) { 
                    if (response.status === "success") {
                        showNotification('top', 'right', response.message, 'success');
                    } else if (response.status === "error") {
                        showNotification('top', 'right', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) { 
                    console.error("AJAX Error: ", error);
                    
                }
            });
        });


            function showNotification(from, align, message, type) {
                $.notify({
                icon: "fas fa-check-circle",
                message: message
                }, {
                type: type,
                timer: 4000,
                placement: {
                    from: from,
                    align: align
                }
                });
            }
        </script>

    </body>
</html>


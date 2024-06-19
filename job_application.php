<?php

    include 'auth.php';
    include 'con.php';

    $email = $_SESSION['email'];

    // Fetch the User_ID based on the email
    $sql = "SELECT `User_ID` FROM `users` WHERE `email` = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();
        
    } else {
        echo "Error: " . $conn->error;
        exit();
    }

    // Fetch job based on the user_id and job_status
    $query = "SELECT j.*, 
               (SELECT COUNT(*) FROM `job_application` ja WHERE ja.job_id = j.job_id) as application_count
            FROM `job` j 
            WHERE j.job_status = 1 AND j.recruiter_id = ? 
            ORDER BY j.date_posted";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $jobs = [];
        while ($row = $result->fetch_assoc()) {
            $jobs[] = $row;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Fetch job based on the user_id and job_status = 0
    $query = "SELECT j.*, 
            (SELECT COUNT(*) FROM `job_application` ja WHERE ja.job_id = j.job_id) as application_count
            FROM `job` j 
            WHERE j.job_status = 0 AND j.recruiter_id = ? 
            ORDER BY j.date_posted";
    if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $Inactivejobs = [];
    while ($row = $result->fetch_assoc()) {
        $Inactivejobs[] = $row;
    }

    $stmt->close();
    } else {
    echo "Error: " . $conn->error;
    }

    $conn->close();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolify Vacancy</title>

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

    <?php include 'navbar.php'; ?>

        <main>

        <header class="site-header">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">Job Application</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Application</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

        <!-- Active Project -->
        <section class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2>Job posted</h2>
                    </div>
                    <?php foreach ($jobs as $jobs): ?>
                    <div class="col-lg-12 col-12">
                        <a href="job_candidate.php?id=<?php echo $jobs['job_id']; ?>" class="project-link">
                            <div class="job-thumb d-flex">
                                <div class="job-image-wrap bg-white shadow-lg">
                                    <img src="<?php echo $project['project_image']; ?>" class="job-image img-fluid" alt="">
                                </div>
                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0"><?php echo $jobs['job_title']; ?></h4>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <p class="job-date mb-0">
                                                <i class="custom-icon bi-clock me-1"></i>
                                                <?php echo $jobs['date_posted']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <p class="applicant-count mb-0">
                                            <strong><?php echo htmlspecialchars($jobs['application_count']); ?></strong> Applicants
                                        </p>
                                        <a href="#" class="deactivate-link" onclick="deactivateStatus(event, '<?php echo $jobs['job_id']; ?>', 'deactivate');">Deactivate</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Inactive Project -->
        <section class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2>Inactive Jobs</h2>
                    </div>
                    <?php foreach ($Inactivejobs as $Inactivejobs): ?>
                    <div class="col-lg-12 col-12">
                        <a href="job_candidate.php?id=<?php echo $project['project_id']; ?>" class="project-link">
                            <div class="job-thumb d-flex">
                                <div class="job-image-wrap bg-white shadow-lg">
                                    <img src="<?php echo $project['project_image']; ?>" class="job-image img-fluid" alt="">
                                </div>
                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0"><?php echo $Inactivejobs['job_title']; ?></h4>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <p class="job-date mb-0">
                                                <i class="custom-icon bi-clock me-1"></i>
                                                <?php echo $Inactivejobs['date_posted']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <p class="applicant-count mb-0">
                                            <strong><?php echo htmlspecialchars($Inactivejobs['application_count']); ?></strong> Applicants
                                        </p>
                                        <a href="#" class="deactivate-link" onclick="activateStatus(event, '<?php echo $Inactivejobs['job_id']; ?>', 'activate');">Activate</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
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
                            <p class="copyright-text">Copyright © Gotto Job 2048</p>
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

        function deactivateStatus(event, jobId, action) {
                event.preventDefault(); 

                // Send an AJAX request to the server-side script
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "job_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the server response
                        alert(xhr.responseText);
                        location.reload();
                    }
                };
                // Send the project ID as data
                xhr.send("job_id=" + jobId + "&action=" + action);
            }

        function activateStatus(event, jobId, action) {
            event.preventDefault(); 

            // Send an AJAX request to the server-side script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "job_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the server response
                    alert(xhr.responseText);
                    location.reload();
                }
            };
            // Send the project ID as data
            xhr.send("job_id=" + jobId + "&action=" + action);
        }


        </script>

    </body>
</html>
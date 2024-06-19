<?php

include "auth.php";
include "con.php";

// Fetch the user_id from users based on the email
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_id = $user['User_ID'];
    $role = $user['role'];
} else {
    echo "User not found";
    exit();
}

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    // Fetch the job details
    $stmt = $conn->prepare("SELECT * FROM job WHERE job_id = ?");
    $stmt->bind_param("s", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $job = $result->fetch_assoc();
        $recruiter_id = $job['recruiter_id'];

        // Fetch the recruiter profile
        $stmt_profile = $conn->prepare("SELECT * FROM recruiter_profile WHERE user_id = ?");
        $stmt_profile->bind_param("s", $recruiter_id);
        $stmt_profile->execute();
        $result_profile = $stmt_profile->get_result();

        if ($result_profile && $result_profile->num_rows > 0) {
            $profile = $result_profile->fetch_assoc();
        } else {
            echo "Profile not found";
            exit();
        }
    } else {
        echo "Job not found";
        exit();
    }
} else {
    echo "Invalid job ID";
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
    <title>Job Details</title>

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
            <!-- Job Details -->
            <section class="job-section section-padding pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <h2 class="job-title mb-0"><?php echo htmlspecialchars($job['job_title']); ?></h2>

                            <div class="job-thumb job-thumb-detail">
                                <div class="d-flex flex-wrap align-items-center border-bottom pt-lg-3 pt-2 pb-3 mb-4">
                                    <p class="job-location mb-0">
                                        <i class="custom-icon bi-geo-alt me-1"></i>
                                        <?php echo htmlspecialchars($job['job_location']); ?>
                                    </p>

                                    <p class="job-date mb-0">
                                        <i class="custom-icon bi-clock me-1"></i>
                                        <?php echo htmlspecialchars($job['date_posted']); ?>
                                    </p>

                                    <p class="job-price mb-0">
                                        <i class="custom-icon bi-cash me-1"></i>
                                        <?php echo htmlspecialchars($job['salary']); ?>
                                    </p>

                                    <div class="d-flex">
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge badge-level"><?php echo htmlspecialchars($job['job_types']); ?></a>
                                        </p>
                                    </div>
                                </div>

                                <h4 class="mt-4 mb-2">Job Description</h4>
                                <p><?php echo nl2br(htmlspecialchars($job['job_desc'])); ?></p>

                                <h5 class="mt-4 mb-3">Requirements</h5>
                                <p><?php echo nl2br(htmlspecialchars($job['requirement'])); ?></p>

                                <?php if ($role !== 'recruiter') { ?>
                                <div class="d-flex justify-content-center flex-wrap mt-5 border-top pt-4">
                                    <button id="applyBtn" class="custom-btn btn mt-2">Apply now</button>
                                </div>

                                <!-- Application Form -->
                                <div id="applicationForm" style="display: none;">
                                    <form id="jobApplicationForm" enctype="multipart/form-data">
                                        <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job_id); ?>">
                                        <input type="hidden" name="applicant_id" value="<?php echo htmlspecialchars($user_id); ?>">

                                        <label for="coverLetter">Cover Letter:</label>
                                        <input type="file" id="coverLetter" name="coverLetter" accept=".pdf,.doc,.docx" required>

                                        <label for="resume">Resume:</label>
                                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">

                                        <button type="submit" class="custom-btn btn mt-2">Submit Application</button>
                                    </form>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 mt-5 mt-lg-0">
                            <div class="job-thumb job-thumb-detail-box bg-white shadow-lg">
                                <div class="d-flex align-items-center">
                                    <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mb-3">
                                        <img src="<?php echo htmlspecialchars($profile['logo']); ?>" class="job-image me-3 img-fluid" alt="">
                                        <p class="mb-0"><?php echo htmlspecialchars($profile['company_name']); ?></p>
                                    </div>
                                </div>

                                <h6 class="mt-3 mb-2">About the Company</h6>
                                <p><?php echo htmlspecialchars($profile['about']); ?></p>

                                <h6 class="mt-4 mb-3">Contact Information</h6>
                                <p class="mb-2">
                                    <i class="custom-icon bi-globe me-1"></i>
                                    <a href="<?php echo htmlspecialchars($profile['website']); ?>" class="site-footer-link">
                                        <?php echo htmlspecialchars($profile['website']); ?>
                                    </a>
                                </p>
                                <p>
                                    <i class="custom-icon bi-envelope me-1"></i>
                                    <a href="mailto:<?php echo htmlspecialchars($profile['contact_email']); ?>" class="site-footer-link">
                                        <?php echo htmlspecialchars($profile['contact_email']); ?>
                                    </a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Browse Jobs -->
            <section class="job-section section-padding">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-12 mb-lg-4">
                            <h3>Similar Jobs</h3>
                        </div>

                        <div class="col-lg-4 col-12 d-flex ms-auto mb-5 mb-lg-4">
                            <a href="job-listings.php" class="custom-btn custom-border-btn btn ms-lg-auto">Browse Job Listings</a>
                        </div>

                        <?php
                            $query = "SELECT * FROM `job` WHERE `job_status` = 1 ORDER BY `date_posted` DESC LIMIT 3";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="job-thumb job-thumb-box">
                                <div class="job-image-box-wrap">
                                    <a href="job-details.html">
                                        <img src="images/jobs/it-professional-works-startup-project.jpg" class="job-image img-fluid" alt="">
                                    </a>

                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge badge-level"><?php echo $row['job_types']; ?></a>
                                        </p>
                                    </div>
                                </div>

                                <div class="job-body">
                                    <h4 class="job-title">
                                        <a href="job-detail.php?id=<?php echo $row['job_id']; ?>" class="job-title-link"><?php echo $row['job_title']; ?></a>
                                    </h4>
                                    
                                    <div class="d-flex align-items-center">
                                        <p class="job-location">
                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                            <?php echo $row['job_location']; ?>
                                        </p>

                                        <p class="job-date">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            <?php echo $row['date_posted']; ?>
                                        </p>
                                    </div>

                                    <div class="d-flex align-items-center border-top pt-3">
                                        <p class="job-price mb-0">
                                            <i class="custom-icon bi-cash me-1"></i>
                                            <?php echo $row['salary']; ?>
                                        </p>

                                        <a href="job-detail.php?id=<?php echo $row['job_id']; ?>" class="custom-btn btn ms-auto">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                        } else {
                            // If no job found
                            echo "No job found";
                        }
                        ?>

                    </div>
                </div>
            </section>


        </main>

        <?php include 'footer.php'; ?>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('applyBtn').addEventListener('click', function() {
                document.getElementById('applicationForm').style.display = 'block';
            });

            document.getElementById('jobApplicationForm').addEventListener('submit', function(event) {
                event.preventDefault();

                var form = document.getElementById('jobApplicationForm');
                var formData = new FormData(form);

                // Validate cover letter
                var coverLetter = document.getElementById('coverLetter').files[0];
                if (!coverLetter) {
                    alert('Please upload a cover letter.');
                    return;
                }

                // Optional: Validate resume
                var resume = document.getElementById('resume').files[0];
                if (!resume) {
                    var confirmSubmit = confirm('Are you sure you want to submit without a resume?');
                    if (!confirmSubmit) {
                        return;
                    }
                }

                // AJAX request to submit the form
                var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'job_process.php', true);
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.status === "success") {
                                    alert(response.message);
                                    location.reload();
                                } else {
                                    alert(response.message);
                                }
                            } else {
                                alert('Error submitting application.');
                            }
                        };

                xhr.send(formData);
            });
        });

        </script>


    </body>
</html>
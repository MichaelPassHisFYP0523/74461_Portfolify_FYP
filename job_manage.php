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
        echo "User ID: " . $user_id . "<br>";
    } else {
        echo "Error: " . $conn->error;
        exit();
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
    
    <body id="top">

    <?php include 'navbar.php'; ?>

        <main>

        <header>
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-12 col-12 text-center">
                        <h1>Job posted</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                                <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Job</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

            <!-- Active Job -->
            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                            <h2>Active Jobs</h2>
                            <div class="mb-4">
                                <div class="col-lg-12 col-12 text-center">
                                    <a href="project_invite.php" class="btn btn-secondary">Job application</a>
                                    <a href="#upload-section" class="btn btn-primary">Post Job</a>
                                </div>
                            </div>
                        </div>

                        <?php
                            include "con.php";

                            $query = "SELECT * FROM `job` WHERE recruiter_id = '$user_id'";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <di class="col-lg-12 col-12">
                            <div class="job-thumb d-flex">
                                <div class="job-image-wrap bg-white shadow-lg">
                                    <img src="images/logos/google.png" class="job-image img-fluid" alt="">
                                </div>

                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0">
                                            <a href="job-detail.php?id=<?php echo $row['job_id']; ?>" class="job-title-link"><?php echo $row['job_title']; ?></a>
                                        </h4>

                                        <div class="d-flex flex-wrap align-items-center">
                                            <p class="job-location mb-0">
                                                <i class="custom-icon bi-geo-alt me-1"></i>
                                                <?php echo $row['job_location']; ?>
                                            </p>

                                            <p class="job-date mb-0">
                                                <i class="custom-icon bi-clock me-1"></i>
                                                <?php echo $row['date_posted']; ?>
                                            </p>

                                            <p class="job-price mb-0">
                                                <i class="custom-icon bi-cash me-1"></i>
                                                <?php echo $row['salary']; ?>
                                            </p>

                                            <div class="d-flex">
                                                <p class="mb-0">
                                                    <a href="job-listings.html" class="badge badge-level"><?php echo $row['job_types']; ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="job-section-btn-wrap">
                                    <a href="#" class="edit-link" 
                                        data-id="<?php echo $row['job_id']; ?>" 
                                        data-title="<?php echo $row['job_title']; ?>" 
                                        data-location="<?php echo $row['job_location']; ?>" 
                                        data-salary="<?php echo $row['salary']; ?>" 
                                        data-types="<?php echo $row['job_types']; ?>" 
                                        data-description="<?php echo $row['job_desc']; ?>"
                                        data-requirements="<?php echo $row['requirement']; ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editJobModal">
                                        Edit
                                    </a> |
                                    <a href="#" class="delete-link" onclick="deleteJob('<?php echo $row['job_id']; ?>')">Delete</a>
                                </div>

                                </div>
                            </div>

                            <?php
                                }
                                } else {
                            ?>
                                <div class="col-lg-12 col-12 text-center">
                                <p class="col-lg-12 col-12 text-center">No job found</p>
                                </div>
                            <?php
                                }
                            ?>
                    
                        </div>

                    </div>
                </div>
            </section>

            <!-- Edit modal -->
            <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editJobModalLabel">Edit Job</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editJobForm">
                                <input type="hidden" id="job_id" name="job_id">
                                <div class="mb-3">
                                    <label for="job_title" class="form-label">Job Title</label>
                                    <input type="text" class="form-control" id="job_title" name="job_title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="job_description" class="form-label">Job Description</label>
                                    <textarea class="form-control" id="job_description" name="job_description" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="job_requirements" class="form-label">Job Requirements</label>
                                    <textarea class="form-control" id="job_requirements" name="job_requirements" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="job_location" class="form-label">Job Location</label>
                                    <input type="text" class="form-control" id="job_location" name="job_location" required>
                                </div>
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary" required>
                                </div>
                                <div class="mb-3">
                                        <label for="job_types">Job Types</label>
                                        <select name="job_types" id="job_types" class="form-control" required>
                                            <option value="" disabled selected >Select Job Type</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="Internship">Internship</option>
                                        </select>
                                    </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Post Job -->
            <section id="upload-section" class="cta-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <form class="custom-form contact-form" id="uploadJob" method="post" enctype="multipart/form-data">
                                <h2 class="text-center mb-4">Post a Job</h2>

                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <label for="job-title">Job Title</label>
                                        <input type="text" name="job_title" id="job-title" class="form-control" placeholder="e.g., Software Engineer" required>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="job-description">Job Description</label>
                                        <textarea name="job_description" id="job-description" rows="6" class="form-control" placeholder="Describe the responsibilities and duties of the job" required></textarea>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="job-requirements">Job Requirements</label>
                                        <textarea name="job_requirements" id="job-requirements" rows="6" class="form-control" placeholder="List the qualifications and skills needed for the job" required></textarea>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="job-salary">Job Salary</label>
                                        <input type="text" name="salary" id="job-salary" class="form-control" placeholder="e.g., $4,000 - $7,000" required>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="job-type">Job Types</label>
                                        <select name="jobType" id="job-type" class="form-control" required>
                                            <option value="" disabled selected>Select Job Type</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="Internship">Internship</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" id="location" class="form-control" placeholder="e.g., New York, NY" required>
                                    </div>

                                    <!-- Hidden input field to store the user_id -->
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                    <!-- Store the action -->
                                    <input type="hidden" name="action" value="upload">

                                    <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                        <button type="button" onclick="uploadJob()" class="form-control" >Post Job</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Footer -->
        <?php include 'footer.php'; ?>
        <!-- End footer -->

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

        <script>
        // Upload a job
        function uploadJob() {
            
            var formData = new FormData(document.getElementById('uploadJob'));

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "job_actions.php", true);
            xhr.onload = function () {
                if (xhr.status == 200) {
                    alert(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send(formData);
        }

        // Delete the job
        function deleteJob(jobId) {
            if (confirm('Are you sure you want to delete this project?')) {
                $.ajax({
                    url: 'job_actions.php',
                    type: 'POST',
                    data: { action: 'delete', job_id: jobId },
                    success: function(response) {
                        if (response == 'success') {
                            alert('Project deleted successfully.');
                            location.reload();
                        } else {
                            alert('Error deleting project: ' + response);
                        }
                    }
                });
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            var editLinks = document.querySelectorAll('.edit-link');
            
            editLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    var jobId = this.getAttribute('data-id');
                    var jobTitle = this.getAttribute('data-title');
                    var jobLocation = this.getAttribute('data-location');
                    var salary = this.getAttribute('data-salary');
                    var jobTypes = this.getAttribute('data-types');
                    var jobDescription = this.getAttribute('data-description');
                    var jobRequirements = this.getAttribute('data-requirements');

                    document.getElementById('job_id').value = jobId;
                    document.getElementById('job_title').value = jobTitle;
                    document.getElementById('job_location').value = jobLocation;
                    document.getElementById('salary').value = salary;
                    document.getElementById('job_types').value = jobTypes;
                    document.getElementById('job_description').value = jobDescription;
                    document.getElementById('job_requirements').value = jobRequirements;

                });
            });

            document.getElementById('editJobForm').addEventListener('submit', function(event) {
                event.preventDefault();
                
                var formData = new FormData(this);
                formData.append('action', 'edit');

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'job_actions.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert('Job updated successfully!');
                        location.reload();
                    } else {
                        alert('Error updating job: ' + xhr.statusText);
                    }
                };
                xhr.send(formData);
            });
        });

        </script>

    </body>
</html>
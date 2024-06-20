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

    <?php include 'navbar.php'; ?>

        <main>

            <!-- Navigation bar -->
            <section class="hero-section d-flex justify-content-center align-items-center">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                            <div class="hero-section-text mt-5">
                                <h2 class="text-white">Are you looking for your dream job to enhance your career?</h6>
                                <a href="job-listings.php" class="custom-btn custom-border-btn btn">Browse More</a>
                            </div>
                        </div>


                    </div>
                </div>
            </section>
            <!-- End nav bar -->


            </p>
        <!-- </section> -->


            <section class="about-section">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-12">
                            <div class="about-image-wrap custom-border-radius-start">
                                <img src="images/professional-asian-businesswoman-gray-blazer.jpg" class="about-image custom-border-radius-start img-fluid" alt="">

                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="custom-text-block">
                                <h2 class="text-white mb-2">Introduction Portfolify</h2>

                                <p class="text-white">An online portfolio web-based system is designed to enable professionals to effectively showcase their portfolio, works, and skills. This platform supports the upload of rich media content, including PDFs, videos, and detailed project descriptions, facilitating a dynamic presentation of their capabilities.</p>

                                <div class="custom-border-btn-wrap d-flex align-items-center mt-5">
                                    <a href="about.php" class="custom-btn custom-border-btn btn me-4">Get to know us</a>

                                    <a href="job-listings.php" class="custom-link smoothscroll">Explore Jobs</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12">
                            <div class="instagram-block">
                                <img src="images/horizontal-shot-happy-mixed-race-females.jpg" class="about-image custom-border-radius-end img-fluid" alt="">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            

            <!-- Latest Job -->
            <section class="job-applications-section section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                            <h2>Latest Jobs</h2>
                        </div>

                        <?php
                            include "con.php";

                            $query = "SELECT * FROM `job` WHERE job_status = 1 ORDER BY `date_posted` DESC LIMIT 6";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <div class="col-lg-12 col-12">
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
                                        <a href="job-detail.php?id=<?php echo $row['job_id']; ?>" class="custom-btn btn">Apply now</a>
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
                </div>
            </section>
            <!-- End latest job -->

            <!-- Latest project -->
            <section class="job-section recent-jobs-section section-padding">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-12 mb-4">
                            <h2>Latest Project to Collaborate</h2>
                        </div>

                        <div class="clearfix"></div>
                    <?php
                        include "con.php";

                        $query = "SELECT * FROM `projects` WHERE `proj_status` = 1 ORDER BY `created_at` DESC LIMIT 6";
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
                                        </div>

                                            <p></p>
                                            <div class="action-flex align-items-center border-top pt-3n-buttons">
                                                <p></p>
                                                <a href="project-detail.php?id=<?php echo $row['project_id']; ?>" class="custom-btn btn ms-auto">View Details</a>
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
            <!-- End latest project -->

            <section class="cta-section">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-10">
                            <h2 class="text-white mb-2">Opening jobs</h2>

                            <p class="text-white">If you are looking for a platform to showcase your project, please create an account or login.</p>
                        </div>

                        <div class="col-lg-4 col-12 ms-auto">
                            <div class="custom-border-btn-wrap d-flex align-items-center mt-lg-4 mt-2">
                                <a href="Sign_Up.html" class="custom-btn custom-border-btn btn me-4">Create an account</a>

                                <a href="job_manage.php" class="custom-link">Post a job</a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>

        <!-- Footer -->
        <?php include "footer.php"; ?>
        <!-- End footer -->

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
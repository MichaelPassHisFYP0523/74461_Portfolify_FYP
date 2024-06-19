<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolify Job Listing</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/owl.carousel.min.css" rel="stylesheet">

        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <link href="css/tooplate-gotto-job.css" rel="stylesheet">
        
        <!--chou bao-->

    </head>
    
    <body class="job-listings-page" id="top">

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
                                <li><a class="dropdown-item active" href="job-listings.html">Job Listings</a></li>

                                <li><a class="dropdown-item" href="job-details.html">Job Details</a></li>
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

            <header class="site-header">
                <div class="section-overlay"></div>

                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-12 col-12 text-center">
                            <h1 class="text-white">Job Listings</h1>

                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Job listings</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
            </header>

            <section class="section-padding pb-0 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <form class="custom-form hero-form" action="#" method="get" role="form">
                                <h3 class="text-white mb-3">Search your dream job</h3>
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi-person custom-icon"></i></span>

                                            <input type="text" name="job-title" id="job-title" class="form-control" placeholder="Job Title">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi-geo-alt custom-icon"></i></span>

                                            <input type="text" name="job-location" id="job-location" class="form-control" placeholder="Location">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi-cash custom-icon"></i></span>

                                            <select class="form-select form-control" name="job-salary" id="job-salary" aria-label="Default select example">
                                                <option selected>Salary Range</option>
                                                <option value="1">$300k - $500k</option>
                                                <option value="2">$10000k - $45000k</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi-laptop custom-icon"></i></span>

                                            <select class="form-select form-control" name="job-remote" id="job-remote" aria-label="Default select example">
                                                <option value="1" selected>Full Time</option>
                                                <option value="2">Internship</option>
                                                <option value="2">Part Time</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <button type="submit" class="form-control">
                                            Search job
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 col-12">
                            <img src="images/4557388.png" class="hero-image img-fluid" alt="">
                        </div>

                    </div>
                </div>
            </section>


            <section class="job-section section-padding">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-12 mb-lg-4">
                            <h3>Jobs available</h3>
                        </div>

                        <div class="col-lg-4 col-12 d-flex align-items-center ms-auto mb-5 mb-lg-4">
                            <p class="mb-0 ms-lg-auto">Sort by:</p>

                            <div class="dropdown dropdown-sorting ms-3 me-4">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSortingButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Newest Jobs
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownSortingButton">
                                    <li><a class="dropdown-item" href="?sort=latest">Latest Jobs</a></li>
                                    <li><a class="dropdown-item" href="?sort=salary">Highest Salary Jobs</a></li>
                                </ul>
                            </div>

                            <div class="d-flex">
                                <a href="#" class="sorting-icon active bi-list me-2"></a>
                                <a href="#" class="sorting-icon bi-grid"></a>
                            </div>
                        </div>


                        <?php
                            include 'con.php';

                            // Default query to fetch jobs
                            $query = "SELECT j.*, rp.*
                                    FROM `job` j
                                    LEFT JOIN `recruiter_profile` rp ON j.recruiter_id = rp.User_ID
                                    WHERE j.job_status = 1";

                            // Check if sorting parameter is set
                            if (isset($_GET['sort'])) {
                                $sort = $_GET['sort'];
                                switch ($sort) {
                                    case 'latest':
                                        // Sort by latest jobs
                                        $query .= " ORDER BY j.date_posted DESC";
                                        break;
                                    case 'salary':
                                        // Sort by highest salary jobs
                                        $query .= " ORDER BY j.salary DESC";
                                        break;
                                    default:
                                        
                                        break;
                                }
                            } else {
                                // Default sorting to newest jobs if no sort parameter is set
                                $query .= " ORDER BY j.date_posted DESC";
                            }

                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="job-thumb job-thumb-box">
                                            <!-- Job Image and Type -->
                                            <div class="job-image-box-wrap">
                                                <a href="job-details.html">
                                                    <img src="images/jobs/pretty-blogger-posing-cozy-apartment.jpg" class="job-image img-fluid" alt="">
                                                </a>
                                                <div class="job-image-box-wrap-info d-flex align-items-center">
                                                    <p class="mb-0">
                                                        <a href="job-listings.html" class="badge badge-level"><?php echo $row['job_types']; ?></a>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Job Details -->
                                            <div class="job-body">
                                                <h4 class="job-title">
                                                    <a href="job-detail.php?id=<?php echo $row['job_id']; ?>" class="job-title-link"><?php echo $row['job_title']; ?></a>
                                                </h4>
                                                <!-- Company Logo and Name -->
                                                <div class="d-flex align-items-center">
                                                    <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                                        <img src="<?php echo $row['logo']; ?>" class="job-image me-3 img-fluid" alt="">
                                                        <p class="mb-0"><?php echo $row['company_name']; ?></p>
                                                    </div>
                                                </div>
                                                <!-- Location and Date Posted -->
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
                                                <!-- Salary and Apply Button -->
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
                                // If no jobs found
                                echo "<div class='col-lg-12 col-12'><p class='text-center'>No jobs found</p></div>";
                            }
                            ?>


                        <div class="col-lg-12 col-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-5">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">Prev</span>
                                        </a>
                                    </li>

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

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


    </body>
</html>
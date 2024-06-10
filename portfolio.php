<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: Sign_In.php");
        exit();
    }

    // Get the sender ID from the URL parameter
    if(isset($_GET['id'])) {
        $sender_id = $_GET['id'];
    } else {
        // Handle the case where project ID is not provided
        echo "Sender ID not provided.";
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
        <title>User Profile</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="index.html">
                    <img src="images/logo.png" class="img-fluid logo-image">
                    <div class="d-flex flex-column">
                        <strong class="logo-text">Portfolify</strong>
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
                            <a class="nav-link active" href="about.html">About Portfolify</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="job-listings.html">Job Listings</a></li>
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
            <section class="about-section">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-12 mt-5 mt-lg-0">
                            <div class="about-image-wrap">
                                <img src="images/horizontal-shot-happy-mixed-race-females.jpg" class="about-image about-image-border-radius img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5 col-12">
                            <div class="about-info-text">
                                <h2 class="mb-0">Introducing Portfolify</h2>
                                <h4 class="mb-2">Get hired. Collaborate in projects and showcase your works </h4>
                                <p>We offer users and recruiters a platform to find jobs, offer jobs, and upload projects to collaborate.</p>
                                <a class="btn custom-btn" data-toggle="modal" data-target="#contactModal">Contact Me!</a>
                                <a href="#" class="btn custom-btn">View My Projects and Portfolios</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>

            <!-- Modal -->
            <div class="modal fade" id="contactModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Get in Touch</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Job/Collaboration Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn custom-btn">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

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

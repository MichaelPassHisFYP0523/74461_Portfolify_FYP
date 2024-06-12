<?php
session_start();

include("con.php");

if (!isset($_SESSION['email'])) {
    header("Location: Sign_In.php");
    exit();
}

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
    $sql = "SELECT `company_name`, `contact_email`, `contact_phone`, `about`, `website`, `logo`, `background` 
            FROM `recruiter_profile` WHERE `User_ID` = ?";
} else {
    $sql = "SELECT `FirstName`, `LastName`, `ProfilePicture`, `Gender`, `Bio`, `Location`, `Skills`, `Education`, 
            `Experience`, `SocialMediaLinks`, `Resume`, `profile_views` FROM `user_profile` WHERE `User_ID` = ?";
}

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $sender_id);
    $stmt->execute();
    $profile_data = $stmt->get_result()->fetch_assoc();
    $stmt->close();
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
                                <p><strong>Contact Email:</strong> <?php echo $profile_data['contact_email']; ?></p>
                                <p><strong>Contact Phone:</strong> <?php echo $profile_data['contact_phone']; ?></p>
                                <p><strong>Website:</strong> <a href="<?php echo $profile_data['website']; ?>" target="_blank"><?php echo $profile_data['website']; ?></a></p>
                            <?php else: ?>
                                <h2 class="mb-0"><?php echo $profile_data['FirstName'] . " " . $profile_data['LastName']; ?></h2>
                                <h4 class="mb-2">Profile</h4>
                                <p><strong>Gender:</strong> <?php echo $profile_data['Gender']; ?></p>
                                <p><strong>Bio:</strong> <?php echo $profile_data['Bio']; ?></p>
                                <p><strong>Social Media Links:</strong> <?php echo $profile_data['SocialMediaLinks']; ?></p>
                            <?php endif; ?>
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
                    <div class="row">
                        <?php
                        // Fetch projects associated with the user
                        $project_query = "SELECT * FROM projects WHERE `user_id` = '$sender_id'";
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

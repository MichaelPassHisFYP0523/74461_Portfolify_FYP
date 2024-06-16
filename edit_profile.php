<?php
// session_start();
    include 'auth.php';
    include 'con.php';

    $email = $_SESSION['email'];

    $user_id = $_SESSION['user_id'];echo $user_id;

    $sql = "SELECT users.*, user_profile.* FROM users
            INNER JOIN user_profile ON users.User_ID = user_profile.User_ID
            WHERE users.email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $fullName = $row['FirstName'] . ' ' . $row['Lastname'];

    } else {
        echo "User not found!";
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
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h1>My profile</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit profile</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

            <section class="contact-section section-padding">
                <div class="container">
                    <div class="section-title text-center">
                        Profile Management
                    </div>

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

                    <ul class="nav nav-tabs" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-picture-tab" data-bs-toggle="tab" data-bs-target="#profile-picture" type="button" role="tab" aria-controls="profile-picture" aria-selected="true">Profile Picture</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info" aria-selected="false">Personal Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="work-experience-tab" data-bs-toggle="tab" data-bs-target="#work-experience" type="button" role="tab" aria-controls="work-experience" aria-selected="false">Work Experience</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="study-background-tab" data-bs-toggle="tab" data-bs-target="#study-background" type="button" role="tab" aria-controls="study-background" aria-selected="false">Educational Background</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="upload-resume-tab" data-bs-toggle="tab" data-bs-target="#upload-resume" type="button" role="tab" aria-controls="upload-resume" aria-selected="false">Upload Resume</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="profileTabContent">

                        <!-- Profile Picture Section -->
                        <div class="tab-pane fade show active" id="profile-picture" role="tabpanel" aria-labelledby="profile-picture-tab">
                            <form action="update_profile.php" method="post" enctype="multipart/form-data" class="mt-4">
                                <div class="text-center">
                                    <h4>Profile Picture</h4>
                                    <img src="<?php echo $row['ProfilePicture'] ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3 mx-auto" style="width: 150px; height: 150px">
                                    <div class="mb-3">
                                        <label for="profilePicture" class="form-label">Change Profile Picture</label>
                                        <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*">
                                    </div>

                                    <!-- Hidden input field to store the user_id -->
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                    
                                    <button type="submit" class="custom-btn btn">Save Profile Picture</button>
                                </div>
                            </form>
                        </div>

                        <!-- Personal Information Section -->
                        <div class="tab-pane fade" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                            <form action="update_profile.php" method="post" class="mt-4">
                                <h4>Personal Information</h4>
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['FirstName'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['Lastname'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio"><?php echo $row['Bio'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="Male" <?php echo ($row['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo ($row['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?php echo $row['Location'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="socialMediaLinks" class="form-label">Social Media Links</label>
                                    <input type="text" class="form-control" id="socialMediaLinks" name="socialMediaLinks" value="<?php echo $row['SocialMediaLinks'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>" readonly>
                                </div>

                                <!-- Hidden input field to store the user_id -->
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                <div class="mb-3 text-center">
                                    <button type="submit" class="custom-btn btn">Save Personal Information</button>
                                </div>
                            </form>
                        </div>

                        <!-- Work Experience Section -->
                        <div class="tab-pane fade" id="work-experience" role="tabpanel" aria-labelledby="work-experience-tab">
                            <form action="update_profile.php" method="post" class="mt-4">
                                <h4>Work Experience</h4>
                                <div class="mb-3">
                                    <label for="workExperience" class="form-label">Work Experience</label>
                                    <textarea class="form-control" id="workExperience" name="workExperience"><?php echo $row['Experience'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="skills" class="form-label">Skills</label>
                                    <textarea class="form-control" id="skills" name="skills"><?php echo $row['Skills'] ?></textarea>
                                </div>

                                <!-- Hidden input field to store the user_id -->
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                <div class="mb-3 text-center">
                                    <button type="submit" class="custom-btn btn">Save Work Experience</button>
                                </div>
                            </form>
                        </div>

                        <!-- Study Background Section -->
                        <div class="tab-pane fade" id="study-background" role="tabpanel" aria-labelledby="study-background-tab">
                            <form action="update_profile.php" method="post" class="mt-4">
                                <h4>Education</h4>
                                <div class="mb-3">
                                    <label for="studyBackground" class="form-label">Education</label>
                                    <textarea class="form-control" id="studyBackground" name="studyBackground"><?php echo $row['Education'] ?></textarea>
                                </div>

                                <!-- Hidden input field to store the user_id -->
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

                                <div class="mb-3 text-center">
                                    <button type="submit" class="custom-btn btn">Save Education</button>
                                </div>
                            </form>
                        </div>

                        <!-- Upload Resume Section -->
                        <div class="tab-pane fade" id="upload-resume" role="tabpanel" aria-labelledby="upload-resume-tab">
                            <form action="update_profile.php" method="post" enctype="multipart/form-data" class="mt-4">
                                <div class="text-center">
                                    <h4>Upload Resume</h4>
                                    <div class="text-center">
                                        <a href="<?php echo htmlspecialchars($row['Resume']); ?>" target="_blank">
                                            <i class="bi bi-file-text"></i> 
                                            View Existing Resume
                                        </a>
                                    </div>
                                    <div class="mb-3">
                                        <label for="resume" class="form-label">Upload Resume</label>
                                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf, .doc, .docx">
                                    </div>

                                    <!-- Hidden input field to store the user_id -->
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                    
                                    <button type="submit" class="custom-btn btn">Upload Resume</button>
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

    </body>
</html>

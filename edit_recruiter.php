<?php

include "auth.php";
include 'con.php';

checkLogin();

$email = $_SESSION['email'];

$user_id = $_SESSION['user_id'];

$sql = "SELECT users.*, recruiter_profile.* FROM users
        INNER JOIN recruiter_profile ON users.User_ID = recruiter_profile.User_ID
        WHERE users.email = '$email'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
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

    <header class="site-header">
        <div class="section-overlay"></div>

        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 col-12 text-center">
                    <h1 class="text-white">Company Profile</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
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
                    <button class="nav-link active" id="logo-picture-tab" data-bs-toggle="tab" data-bs-target="#logo-picture" type="button" role="tab" aria-controls="logo-picture" aria-selected="true">Company Logo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="company-info-tab" data-bs-toggle="tab" data-bs-target="#company-info" type="button" role="tab" aria-controls="company-info" aria-selected="false">Company Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="study-background-tab" data-bs-toggle="tab" data-bs-target="#company-background" type="button" role="tab" aria-controls="company-background" aria-selected="false">Company Background</button>
                </li>
            </ul>
            <div class="tab-content" id="profileTabContent">

                <!-- Company Logo Section -->
                <div class="tab-pane fade show active" id="logo-picture" role="tabpanel" aria-labelledby="logo-picture-tab">
                    <form action="update_recruiter.php" method="post" enctype="multipart/form-data" class="mt-4">
                        <div class="text-center">
                            <h4>Profile Picture</h4>
                            <img src="<?php echo $row['logo'] ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3 mx-auto" style="width: 150px; height: 150px">
                            <div class="mb-3">
                                <label for="logoPicture" class="form-label">Change Profile Picture</label>
                                <input type="file" class="form-control" id="logoPicture" name="logoPicture" accept="image/*">
                            </div>
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                            <button type="submit" class="custom-btn btn">Save Profile Picture</button>
                        </div>
                    </form>
                </div>

                <!-- Personal Information Section -->
                <div class="tab-pane fade" id="company-info" role="tabpanel" aria-labelledby="company-info-tab">
                    <form action="update_recruiter.php" method="post" class="mt-4">
                        <h4>Company Information</h4>
                        <div class="mb-3">
                            <label for="companyName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo $row['company_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="about" class="form-label">About</label>
                            <textarea class="form-control" id="about" name="about"><?php echo $row['about'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="contactEmail" class="form-label">Contact Email</label>
                            <input type="text" class="form-control" id="contactEmail" name="contactEmail" value="<?php echo $row['contact_email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Contact Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['contact_phone'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label">Company Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="<?php echo $row['website'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>" readonly>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                        <div class="mb-3 text-center">
                            <button type="submit" class="custom-btn btn">Save Company Information</button>
                        </div>
                    </form>
                </div>

                <!-- Company Background Section -->
                <div class="tab-pane fade" id="company-background" role="tabpanel" aria-labelledby="company-background-tab">
                    <form action="update_recruiter.php" method="post" class="mt-4">
                        <h4>Company Background</h4>
                        <div class="mb-3">
                            <label for="companyBackground" class="form-label">Background</label>
                            <textarea class="form-control" id="background" name="background"><?php echo $row['background'] ?></textarea>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                        <div class="mb-3 text-center">
                            <button type="submit" class="custom-btn btn">Save Background</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<?php include 'footer.php'; ?>
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

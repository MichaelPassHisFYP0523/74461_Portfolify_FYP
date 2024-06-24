<?php
include 'auth.php'; 
include 'con.php'; 

$email = $_SESSION['email']; 

// Fetch user's preferences
$sqlUser = "SELECT * FROM user_profile WHERE email = '$email'";
$resultUser = $conn->query($sqlUser);

if ($resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $preferIndustry = $rowUser['prefer_industry'];
    $expectedSalary = $rowUser['expected_salary'];

    $sqlJobs = "SELECT job.*, recruiter_profile.company_name, recruiter_profile.logo 
                FROM job 
                LEFT JOIN recruiter_profile ON job.recruiter_id = recruiter_profile.User_ID
                WHERE job.job_industry LIKE '%$preferIndustry%' 
                OR job.salary LIKE '%$expectedSalary%'";
    $resultJobs = $conn->query($sqlJobs);

    if ($resultJobs->num_rows > 0) {
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolify</title>
    <!-- CSS FILES -->
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/owl.theme.default.min.css" rel="stylesheet">
    <link href="css/tooplate-gotto-job.css" rel="stylesheet">
</head>
<body class="job-listings-page" id="top">

<main>
    <?php include 'navbar.php'; ?>

    <header class="site-header">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h1 class="text-white">Job recommendation</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Recommendation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="job-section section-padding">
        <div class="container">
            <div class="row">
                <?php
                while ($rowJobs = $resultJobs->fetch_assoc()) {
                ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="job-thumb job-thumb-box">
                            <div class="job-image-box-wrap">
                                <a href="job-detail.php?id=<?php echo $rowJobs['job_id']; ?>">
                                    <img src="<?php echo $rowJobs['job_image']; ?>" class="job-image img-fluid" alt="">
                                </a>
                                <div class="job-image-box-wrap-info d-flex align-items-center">
                                    <p class="mb-0">
                                        <a href="job-listings.html" class="badge badge-level"><?php echo $rowJobs['job_types']; ?></a>
                                    </p>
                                </div>
                            </div>
                            <div class="job-body">
                                <h4 class="job-title">
                                    <a href="job-detail.php?id=<?php echo $rowJobs['job_id']; ?>" class="job-title-link"><?php echo $rowJobs['job_title']; ?></a>
                                </h4>
                                <div class="d-flex align-items-center">
                                    <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                        <img src="<?php echo $rowJobs['logo']; ?>" class="job-image me-3 img-fluid" alt="">
                                        <p class="mb-0"><?php echo $rowJobs['company_name']; ?></p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="job-location">
                                        <i class="custom-icon bi-geo-alt me-1"></i>
                                        <?php echo $rowJobs['job_location']; ?>
                                    </p>
                                    <p class="job-date">
                                        <i class="custom-icon bi-clock me-1"></i>
                                        <?php echo $rowJobs['date_posted']; ?>
                                    </p>
                                </div>
                                <div class="d-flex align-items-center border-top pt-3">
                                    <p class="job-price mb-0">
                                        <i class="custom-icon bi-cash me-1"></i>
                                        <?php echo $rowJobs['salary']; ?>
                                    </p>
                                    <a href="job-detail.php?id=<?php echo $rowJobs['job_id']; ?>" class="custom-btn btn ms-auto">Apply now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</main>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>
</body>
</html>

<?php
    } else {
        echo '<p>No jobs found matching your preferences.</p>';
    }
} else {
    echo '<p>User preferences not found.</p>';
}

$conn->close(); // Close database connection
?>

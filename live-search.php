<?php
include 'con.php';

$query = "SELECT j.*, rp.*
          FROM `job` j
          LEFT JOIN `recruiter_profile` rp ON j.recruiter_id = rp.User_ID
          WHERE j.job_status = 1";

if (isset($_GET['jobTitle']) && !empty($_GET['jobTitle'])) {
    $jobTitle = mysqli_real_escape_string($conn, $_GET['jobTitle']);
    $query .= " AND j.job_title LIKE '%$jobTitle%'";
}

if (isset($_GET['jobLocation']) && !empty($_GET['jobLocation'])) {
    $jobLocation = mysqli_real_escape_string($conn, $_GET['jobLocation']);
    $query .= " AND j.job_location LIKE '%$jobLocation%'";
}

if (isset($_GET['jobSalary']) && !empty($_GET['jobSalary']) && $_GET['jobSalary'] != 'Salary Range') {
    $jobSalary = mysqli_real_escape_string($conn, $_GET['jobSalary']);
    switch ($jobSalary) {
        case '1':
            $query .= " AND j.salary BETWEEN 0 AND 3000";
            break;
        case '2':
            $query .= " AND j.salary BETWEEN 3000 AND 10000";
            break;
        case '3':
            $query .= " AND j.salary BETWEEN 10000000 AND 45000000";
            break;
    }
}

if (isset($_GET['jobRemote']) && !empty($_GET['jobRemote']) && $_GET['jobRemote'] != 'Remote') {
    $jobRemote = mysqli_real_escape_string($conn, $_GET['jobRemote']);
    switch ($jobRemote) {
        case '1':
            $query .= " AND j.job_types = 'Full Time'";
            break;
        case '2':
            $query .= " AND j.job_types = 'Internship'";
            break;
        case '3':
            $query .= " AND j.job_types = 'Part Time'";
            break;
    }
}

// Order by date_posted in descending order to get the latest job first
$query .= " ORDER BY j.date_posted DESC";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="job-thumb job-thumb-box">
                <div class="job-image-box-wrap">
                    <a href="job-detail.php?id=<?php echo $row['job_id']; ?>">
                        <img src="<?php echo $row['job_image']; ?>" class="job-image img-fluid" alt="">
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
                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                            <img src="<?php echo $row['logo']; ?>" class="job-image me-3 img-fluid" alt="">
                            <p class="mb-0"><?php echo $row['company_name']; ?></p>
                        </div>
                    </div>
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
    echo '<div class="col-lg-12 col-12"><p class="text-center">No jobs found</p></div>';
}

mysqli_close($conn);
?>

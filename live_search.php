<?php
// Include your database connection file
include 'con.php';

// Fetch parameters from GET request
$education = isset($_GET['education']) ? mysqli_real_escape_string($conn, $_GET['education']) : '';
$jobLocation = isset($_GET['jobLocation']) ? mysqli_real_escape_string($conn, $_GET['jobLocation']) : '';
$jobSalary = isset($_GET['jobSalary']) ? mysqli_real_escape_string($conn, $_GET['jobSalary']) : '';
$jobType = isset($_GET['jobType']) ? mysqli_real_escape_string($conn, $_GET['jobType']) : '';

// Construct base query
$query = "SELECT *
          FROM `user_profile`";

// Build WHERE clause based on provided parameters
$whereClause = [];
if (!empty($education)) {
    $whereClause[] = "`Education` LIKE '%$education%'";
}
if (!empty($jobLocation)) {
    $whereClause[] = "`Location` LIKE '%$jobLocation%'";
}
if (!empty($jobSalary) && $jobSalary != 'Salary Range') {
    switch ($jobSalary) {
        case '1':
            $whereClause[] = "`expected_salary` BETWEEN 0 AND 3000";
            break;
        case '2':
            $whereClause[] = "`expected_salary` BETWEEN 3000 AND 10000";
            break;
        case '3':
            $whereClause[] = "`expected_salary` > 10000";
            break;
    }
}
if (!empty($jobType) && $jobType != 'Work Types') {
    switch ($jobType) {
        case '1':
            $whereClause[] = "`availability` = 'Now'";
            break;
        case '2':
            $whereClause[] = "`availability` = '2 weeks'";
            break;
        case '4':
            $whereClause[] = "`availability` = '4 weeks'";
            break;
        case '8':
            $whereClause[] = "`availability` = '8 weeks'";
            break;
        case '12':
            $whereClause[] = "`availability` = '12 weeks'";
            break;
    }
}

// Combine conditions with AND
if (!empty($whereClause)) {
    $query .= " WHERE " . implode(" AND ", $whereClause);
}

// Execute query
$result = mysqli_query($conn, $query);

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    // Output HTML for user cards
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <img src="<?php echo $row['ProfilePicture']; ?>" class="card-img-top" alt="User Image" style="max-height: 200px; max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['FirstName'] . ' ' . $row['Lastname']; ?></h5>
                    <p class="card-text"><?php echo $row['Location']; ?></p>
                    <p class="card-text"><?php echo $row['Education']; ?></p>
                    <p class="card-text"><?php echo $row['Skills']; ?></p>
                    <a href="portfolio.php?id=<?php echo $row['User_ID']; ?>" class="btn btn-primary">View Profile</a>
                </div>
            </div>
        </div>
<?php
    }
} else {
    // If no results found
    echo '<div class="col-lg-12"><p class="text-center">No users found</p></div>';
}

// Close database connection
mysqli_close($conn);
?>

<?php
include "con.php";

$q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
$industry = isset($_GET['industry']) ? mysqli_real_escape_string($conn, $_GET['industry']) : '';

$query = "SELECT * FROM `projects` WHERE `proj_status` = 1";
if ($q) {
    $query .= " AND `title` LIKE '%$q%'";
}
if ($industry) {
    $query .= " AND `proj_field` = '$industry'";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-lg-4 col-md-6 col-12">';
        echo '<div class="job-thumb job-thumb-box">';
        echo '<div class="job-image-box-wrap">';
        echo '<img src="'.htmlspecialchars($row['project_image']).'" class="job-image img-fluid" alt="project image">';
        echo '</div>';
        echo '<div class="job-body">';
        echo '<h4 class="job-title">';
        echo '<a href="project-detail.php?id='.htmlspecialchars($row['project_id']).'" class="job-title-link">'.htmlspecialchars($row['title']).'</a>';
        echo '</h4>';
        echo '<div class="job-details">';
        echo '<p>'.htmlspecialchars($row['description']).'</p>';
        echo '<span class="badge badge-level"> '.htmlspecialchars($row['proj_field']).'</span>'; // Added proj_field
        echo '</div>';
        echo '<p>';
        echo '</p>';
        echo '<div class="action-flex align-items-center border-top pt-3 n-buttons">';
        echo '<p>';
        echo '</p>';
        echo '<a href="project-detail.php?id='.htmlspecialchars($row['project_id']).'" class="custom-btn btn ms-auto">View Details</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="col-lg-12 col-12 text-center">';
    echo '<p>No projects found</p>';
    echo '</div>';
}
?>

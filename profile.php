<?php
    include 'auth.php';
    include 'con.php';

    // Check if the database connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];

    // Fetch the user's role
    $sql = "SELECT role FROM users WHERE User_ID = '$user_id'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error fetching user role: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $role = $user['role'];
        
        if ($role === 'user') {
            $sql = "SELECT * FROM user_profile WHERE User_ID = '$user_id'";
        } else if ($role === 'recruiter') {
            $sql = "SELECT * FROM recruiter_profile WHERE User_ID = '$user_id'";
        }
        $profile_result = $conn->query($sql);

        if (!$profile_result) {
            die("Error fetching profile: " . $conn->error);
        }

        if ($profile_result->num_rows == 1) {
            $profile = $profile_result->fetch_assoc();
        } else {
            session_destroy();
            header("Location: Sign_In.php");
            exit();
        }

        // Count projects
        $project_count_sql = "SELECT COUNT(*) AS project_count FROM projects WHERE user_id = '$user_id'";
        $project_count_result = $conn->query($project_count_sql);
        if (!$project_count_result) {
            die("Error counting projects: " . $conn->error);
        }
        $project_count = $project_count_result->fetch_assoc()['project_count'];

        // Count collaboration invites
        $collab_count_sql = "SELECT COUNT(*) AS collab_count FROM collab_invites WHERE receiver_id = '$user_id'";
        $collab_count_result = $conn->query($collab_count_sql);
        if (!$collab_count_result) {
            die("Error counting collaboration invites: " . $conn->error);
        }
        $collab_count = $collab_count_result->fetch_assoc()['collab_count'];
        
        // Fetch approved collaborated projects
        $collab_projects_sql = "SELECT p.* FROM projects p 
                                JOIN collab_invites ci ON p.project_id = ci.proj_id
                                WHERE ci.sender_id = '$user_id' AND ci.status = 'accepted'";
        $collab_projects_result = $conn->query($collab_projects_sql);
        if (!$collab_projects_result) {
            die("Error fetching collaborated projects: " . $conn->error);
        }
        $collab_projects = [];
        if ($collab_projects_result->num_rows > 0) {
            while ($row = $collab_projects_result->fetch_assoc()) {
                $collab_projects[] = $row;
            }
        }

        // Fetch profile views data
        $views_sql = "SELECT * FROM profile_views WHERE profile_id = ? ORDER BY view_date";
        $stmt = $conn->prepare($views_sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $views_result = $stmt->get_result();
        if (!$views_result) {
            die("Error fetching profile views: " . $conn->error);
        }
        
        $dates = [];
        $views = [];

        while ($row = $views_result->fetch_assoc()) {
            $dates[] = $row['view_date'];
            $views[] = $row['view_count'];
        }

    } else {
        session_destroy();
        header("Location: Sign_In.php");
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

    <title>Portfolify Profile</title>
    
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
                        <h1 class="text-white">My Profile</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

        <!-- Profile Overview -->
        <section class="contact-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-lg-6 col-12 mb-lg-5 mb-3 text-center">
                    <img src="<?php echo $role === 'user' ? $profile['ProfilePicture'] : $profile['logo']; ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3 mx-auto" style="width: 150px; height: 150px;">
                    <h4>
                        <?php 
                        echo $role === 'user' ? $profile['FirstName'] . ' ' . $profile['Lastname'] : $profile['company_name']; 
                        ?>
                    </h4>
                    <h5><?php echo $role === 'user' ? $profile['Bio'] : $profile['about']; ?></h5>
                    <?php if ($role === 'user'): ?>
                        <h5><?php echo $profile['Gender']; ?></h5>
                        <button class="custom-btn btn" onclick="window.location.href='edit_profile.php'">Edit Profile</button>
                    <?php else: ?>
                        <button class="custom-btn btn" onclick="window.location.href='edit_recruiter.php'">Edit Profile</button>
                    <?php endif; ?>
                </div>


                    <div class="col-lg-5 col-12 mb-3 mx-auto">
                        <div class="contact-info-wrap">

                            <div class="contact-info d-flex align-items-center">
                                <i class="custom-icon bi-calendar-event"></i>

                                <p class="mb-0">
                                    <span class="contact-info-small-title"><?php echo $profile['LastActive']; ?></span>

                                    <a href="#" class="site-footer-link">
                                    Last Active
                                    </a>
                                </p>
                            </div>

                            <div class="contact-info d-flex align-items-center">
                                <i class="custom-icon bi-person-check"></i>

                                <p class="mb-0">
                                    <span class="contact-info-small-title"><?php echo $project_count; ?></span>

                                    <a href="tel: 305-240-9671" class="site-footer-link">
                                        Project Done
                                    </a>
                                </p>
                            </div>

                            <div class="contact-info d-flex align-items-center">
                                <i class="custom-icon bi-envelope"></i>

                                <p class="mb-0">
                                    <span class="contact-info-small-title"><?php echo $collab_count; ?></span>

                                    <a href=# class="site-footer-link">
                                        Collaboration Request
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <!-- Graph Section -->
        <section class="projects-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h2>Profile Views Over Time</h2>
                        <canvas id="viewsChart" style="width: 100%; height: 200px;"></canvas>
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
                        <div class="row mb-4">
                            <div class="col-lg-12 col-12 text-center">
                                <a href="project_invite.php" class="btn btn-secondary">Collaboration Invite</a>
                                <a href="project_manage.php" class="btn btn-secondary">Manage Projects</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    // Fetch projects associated with the user
                    $project_query = "SELECT * FROM projects WHERE user_id = '$user_id'";
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

        <!-- Approved Collaborated Projects Section -->
        <section class="projects-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h2>Collaborated Projects</h2>
                    </div>
                </div>
                <div class="row">
                    <?php if (!empty($collab_projects)) {
                        foreach ($collab_projects as $project) { ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100"> 
                                    <img src="<?php echo $project['project_image']; ?>" class="card-img-top" alt="Project Image">
                                    <div class="card-body d-flex flex-column"> 
                                        <h5 class="card-title"><?php echo $project['title']; ?></h5>
                                        <p class="card-text flex-grow-1"><?php echo $project['description']; ?></p> 
                                    </div>
                                </div>
                            </div>
                    <?php } } else { ?>
                            <div class="col-lg-12 col-12 text-center">
                                <p>No approved collaborated projects found.</p>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </section>


        <!-- Job Section (Visible only to recruiters) -->
        <?php if ($role === 'recruiter'): ?>
            <section class="projects-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h2>Job Posted</h2>
                        <div class="row mb-4">
                            <div class="col-lg-12 col-12 text-center">
                                <a href="job_application.php" class="btn btn-secondary">Job application</a>
                                <a href="job_manage.php" class="btn btn-secondary">Manage Jobs</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    // Fetch projects associated with the user
                    $job_query = "SELECT * FROM job WHERE recruiter_id = '$user_id'";
                    $job_result = $conn->query($job_query);

                    if ($job_result->num_rows > 0) {
                        while ($job_row = $job_result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100"> 
                                    
                                    <div class="card-body d-flex flex-column"> 
                                        <h5 class="card-title"><?php echo $job_row['job_title']; ?></h5>
                                        <p class="card-text flex-grow-1"><?php echo $job_row['date_posted']; ?>
                                        <?php echo $job_row['job_location']; ?>
                                        <?php echo $job_row['job_types']; ?></p> 
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-lg-12 col-12 text-center">
                            <p>No job found.</p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'?>
    <!-- End footer -->

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('viewsChart').getContext('2d');
            const viewsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [{
                        label: 'Profile Views',
                        data: <?php echo json_encode($views); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
    </script>

</body>
</html>

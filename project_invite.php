<?php

    include 'auth.php';
    include 'con.php';

    $email = $_SESSION['email'];

    // Fetch the User_ID based on the email
    $sql = "SELECT `User_ID` FROM `users` WHERE `email` = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
        exit();
    }

    // Fetch projects based on the user_id and proj_status
    $query = "SELECT p.*, 
                    (SELECT COUNT(*) FROM `collab_invites` ci WHERE ci.proj_id = p.project_id) as applicant_count
            FROM `projects` p 
            WHERE p.proj_status = 1 AND p.user_id = ? 
            ORDER BY p.created_at";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Fetch inactive projects
    $queryInactive = "SELECT p.*, 
                    (SELECT COUNT(*) FROM `collab_invites` ci WHERE ci.proj_id = p.project_id) as applicant_count
                    FROM `projects` p 
                    WHERE p.proj_status = 0 AND p.user_id = ? 
                    ORDER BY p.created_at";
    if ($stmtInactive = $conn->prepare($queryInactive)) {
        $stmtInactive->bind_param("s", $user_id);
        $stmtInactive->execute();
        $resultInactive = $stmtInactive->get_result();

        $inactiveProjects = [];
        while ($row = $resultInactive->fetch_assoc()) {
            $inactiveProjects[] = $row;
        }

        $stmtInactive->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolify Project</title>

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

    <?php include 'navbar.php'; ?>

        <main>

        <header class="site-header">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">Collaboration</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Collab</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

        <!-- Active Project -->
        <section class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2>Active Project</h2>
                    </div>
                    <?php foreach ($projects as $project): ?>
                    <div class="col-lg-12 col-12">
                        <a href="project_candidate.php?id=<?php echo $project['project_id']; ?>" class="project-link">
                            <div class="job-thumb d-flex">
                                <div class="job-image-wrap bg-white shadow-lg">
                                    <img src="<?php echo $project['project_image']; ?>" class="job-image img-fluid" alt="">
                                </div>
                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0"><?php echo $project['title']; ?></h4>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <p class="job-date mb-0">
                                                <i class="custom-icon bi-clock me-1"></i>
                                                <?php echo $project['created_at']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <p class="applicant-count mb-0">
                                            <strong><?php echo htmlspecialchars($project['applicant_count']); ?></strong> Applicants
                                        </p>
                                        <a href="#" class="deactivate-link" onclick="deactivateStatus(event, '<?php echo $project['project_id']; ?>', 'deactivate');">Deactivate</a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Inactive Project -->
        <section class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2>Inactive Project</h2>
                    </div>
                    <?php foreach ($inactiveProjects as $inactiveProjects): ?>
                    <div class="col-lg-12 col-12">
                        <div class="job-thumb d-flex">
                            <div class="job-image-wrap bg-white shadow-lg">
                                <img src="<?php echo $inactiveProjects['project_image']; ?>" class="job-image img-fluid" alt="">
                            </div>
                            <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                <div class="mb-3">
                                    <h4 class="job-title mb-lg-0">
                                        <a href="job-details.html" class="job-title-link"><?php echo $inactiveProjects['title']; ?></a>
                                    </h4>

                                    <div class="d-flex flex-wrap align-items-center">
                                        <p class="job-date mb-0">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            <?php echo $inactiveProjects['created_at']; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="ms-auto">
                                    <p class="applicant-count mb-0">
                                        <strong><?php echo htmlspecialchars($inactiveProjects['applicant_count']); ?></strong> Applicants
                                    </p>
                                        <a href="#" class="deactivate-link" onclick="activateProject(event, '<?php echo $inactiveProjects['project_id']; ?>', 'activate');">Activate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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

        <script>

        function deactivateStatus(event, projectId, action) {
                event.preventDefault(); 

                // Send an AJAX request to the server-side script
                var xhr = new XMLHttpRequest();
            xhr.open("POST", "project_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the server response
                        alert(xhr.responseText);
                        location.reload();
                        // You can also update the UI as needed
                    }
                };
                // Send the project ID as data
                xhr.send("project_id=" + projectId + "&action=" + action);
            }

        function activateProject(event, projectId, action) {
            event.preventDefault(); 

            // Send an AJAX request to the server-side script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "project_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the server response
                    alert(xhr.responseText);
                    location.reload();
                    // You can also update the UI as needed
                }
            };
            // Send the project ID as data
            xhr.send("project_id=" + projectId + "&action=" + action);
        }


        </script>

    </body>
</html>
<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: Sign_In.php");
        exit();
    }

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
        echo "User ID: " . $user_id . "<br>";
    } else {
        echo "Error: " . $conn->error;
        exit();
    }

    // Get the project ID from the URL parameter
    if(isset($_GET['id'])) {
        $project_id = $_GET['id'];
    } else {
        // Handle the case where project ID is not provided
        echo "Project ID not provided.";
        exit();
    }

    // Fetch project title
    if ($stmt = $conn->prepare("SELECT title FROM projects WHERE project_id = ?")) {
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $stmt->bind_result($project_title);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
        exit();
    }

    // Fetch collab invites for the given project ID
    $query = "SELECT ci.*, u.email, u.role
            FROM collab_invites ci
            INNER JOIN users u ON ci.sender_id = u.User_ID OR ci.receiver_id = u.User_ID
            WHERE ci.proj_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $collab_invites = [];
        while ($row = $result->fetch_assoc()) {
            $collab_invites[] = $row;
        }

        $stmt->close();
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

        <title>Portfolify</title>

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

        <!-- Collab invites -->
        <section class="collab-invites-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2><?php echo $project_title ?></h2>
                        <h2>Collaboration Requests</h2>
                    </div>
                    <?php if (!empty($collab_invites)) { ?>
                        <?php foreach ($collab_invites as $invite): ?>
                        <div class="col-lg-12 col-12 mb-4">
                            <div class="job-thumb d-flex">
                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0">From: <?php echo $invite['email']; ?></h4>
                                        <h4 class="job-title mb-lg-0">From: <?php echo $invite['sender_id']; ?></h4>
                                        <p class="job-role"><strong>Role:</strong> <?php echo $invite['role']; ?></p>
                                        <p class="job-message"><strong>Message:</strong> <?php echo $invite['message']; ?></p>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <div class="col-lg-12 col-12 text-center">
                            <p>No collaboration requests found.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        </main>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-12 d-flex align-items-center">
                            <p class="copyright-text">Copyright © Gotto Job 2048</p>
                        </div>

                        <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>

                    </div>
                </div>
            </div>
        </footer>
        <!-- End footer -->

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

        <script>
        </script>

    </body>
</html>
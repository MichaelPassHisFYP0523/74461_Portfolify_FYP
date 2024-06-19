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

    $collab_invites = [];

    if (isset($_GET['id'])) {
        $project_id = $_GET['id'];
    
        $sql = "SELECT ci.*, u.email, u.role, u.created_at AS user_created_at
                FROM collab_invites ci
                JOIN users u ON ci.sender_id = u.User_ID
                WHERE ci.proj_id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $project_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $collab_invites[] = $row;
            }
            
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "No project ID provided.";
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
                                <li class="breadcrumb-item"><a href="project_invite.php">Collab</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Collaboration Requests</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

        <!-- Collab invites -->
        <section class="collab-invites-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2><strong>Title: </strong><?php echo $project_title ?></h2>
                    </div>
                    <?php if (!empty($collab_invites)) { ?>
                        <?php foreach ($collab_invites as $invite): ?>
                        <div class="col-lg-12 col-12 mb-4">
                            <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">
                                <div class="job-thumb d-flex">
                                    <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                            <p class="job-title mb-lg-0"><strong>From:</strong> <?php echo $invite['email']; ?></p>
                                            <p class="job-message"><strong>Message:</strong> </p>
                                            <p><?php echo $invite['message']; ?></p>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
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
        <?php include 'footer.php'; ?>
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
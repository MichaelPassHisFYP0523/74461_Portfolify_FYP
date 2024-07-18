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

$collab_invites_pending = [];
$collab_invites_accepted = [];
$collab_invites_rejected = [];

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    // Fetch pending collaboration invites
    $sql_pending = "SELECT ci.*, u.email, u.role, u.created_at AS user_created_at
                    FROM collab_invites ci
                    JOIN users u ON ci.sender_id = u.User_ID
                    WHERE ci.proj_id = ? AND ci.status = 'pending'";
    if ($stmt = $conn->prepare($sql_pending)) {
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $result_pending = $stmt->get_result();
        
        while ($row = $result_pending->fetch_assoc()) {
            $collab_invites_pending[] = $row;
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Fetch accepted collaboration invites
    $sql_accepted = "SELECT ci.*, u.email, u.role, u.created_at AS user_created_at
                     FROM collab_invites ci
                     JOIN users u ON ci.sender_id = u.User_ID
                     WHERE ci.proj_id = ? AND ci.status = 'accepted'";
    if ($stmt = $conn->prepare($sql_accepted)) {
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $result_accepted = $stmt->get_result();
        
        while ($row = $result_accepted->fetch_assoc()) {
            $collab_invites_accepted[] = $row;
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Fetch rejected collaboration invites
    $sql_rejected = "SELECT ci.*, u.email, u.role, u.created_at AS user_created_at
                     FROM collab_invites ci
                     JOIN users u ON ci.sender_id = u.User_ID
                     WHERE ci.proj_id = ? AND ci.status = 'rejected'";
    if ($stmt = $conn->prepare($sql_rejected)) {
        $stmt->bind_param("s", $project_id);
        $stmt->execute();
        $result_rejected = $stmt->get_result();
        
        while ($row = $result_rejected->fetch_assoc()) {
            $collab_invites_rejected[] = $row;
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/tooplate-gotto-job.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
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

        <!-- Project Title -->
        <section class="collab-invites-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2><strong>Title: </strong><?php echo $project_title ?></h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pending Collab invites -->
        <?php if (!empty($collab_invites_pending)) { ?>
            <section class="collab-invites-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                            <h2><strong>Pending</strong></h2>
                        </div>
                        <?php foreach ($collab_invites_pending as $invite): ?>
                            <div class="col-lg-12 col-12 mb-4">
                                <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">
                                    <div class="job-thumb d-flex">
                                        <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                            <div class="mb-3">
                                                <p class="job-title mb-lg-0"><strong>From:</strong> <?php echo $invite['email']; ?></p>
                                                <p class="job-message"><strong>Message:</strong></p>
                                                <p><?php echo $invite['message']; ?></p>
                                            </div>
                                            <div class="ms-auto">
                                                <a href="#" class="approve-invite" data-id="<?php echo $invite['collab_id']; ?>">Approve</a> |
                                                <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">View Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <section class="collab-invites-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <p>No pending collaboration requests found.</p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- Accepted Collab invites -->
        <?php if (!empty($collab_invites_accepted)) { ?>
            <section class="collab-invites-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                            <h2><strong>Accepted</strong></h2>
                        </div>
                        <?php foreach ($collab_invites_accepted as $invite): ?>
                            <div class="col-lg-12 col-12 mb-4">
                                <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">
                                    <div class="job-thumb d-flex">
                                        <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                            <div class="mb-3">
                                                <p class="job-title mb-lg-0"><strong>From:</strong> <?php echo $invite['email']; ?></p>
                                                <p class="job-message"><strong>Message:</strong></p>
                                                <p><?php echo $invite['message']; ?></p>
                                            </div>
                                            <div class="ms-auto">
                                                <a href="#" class="approve-invite" data-id="<?php echo $invite['collab_id']; ?>">Approve</a> |
                                                <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">View Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <section class="collab-invites-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <p>No accepted collaboration requests found.</p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- Rejected Collab invites -->
        <?php if (!empty($collab_invites_rejected)) { ?>
            <section class="collab-invites-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                            <h2><strong>Rejected</strong></h2>
                        </div>
                        <?php foreach ($collab_invites_rejected as $invite): ?>
                            <div class="col-lg-12 col-12 mb-4">
                                <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">
                                    <div class="job-thumb d-flex">
                                        <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                            <div class="mb-3">
                                                <p class="job-title mb-lg-0"><strong>From:</strong> <?php echo $invite['email']; ?></p>
                                                <p class="job-message"><strong>Message:</strong></p>
                                                <p><?php echo $invite['message']; ?></p>
                                            </div>
                                            <div class="ms-auto">
                                                <a href="#" class="approve-invite" data-id="<?php echo $invite['collab_id']; ?>">Approve</a> |
                                                <a href="portfolio.php?id=<?php echo $invite['sender_id']; ?>">View Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php } else { ?>
            <section class="collab-invites-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <p>No rejected collaboration requests found.</p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).on('click', '.approve-invite', function(e) {
            e.preventDefault();
            var inviteId = $(this).data('id');

            $.ajax({
                url: 'approve_invite.php',
                type: 'POST',
                data: { invite_id: inviteId },
                dataType: 'json',
                success: function(response) {
                    if (response && response.status === 'success') {
                        alert('Invite approved successfully!');
                        location.reload();
                    } else {
                        var errorMessage = response && response.message ? response.message : 'Unknown error';
                        alert('Error: ' + errorMessage);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    alert('An error occurred while processing the request.');
                }
            });
        });
    </script>
</body>
</html>

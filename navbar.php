<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="images/logo.png" class="img-fluid logo-image">
            <div class="d-flex flex-column">
                <strong class="logo-text">Portfolify</strong>
                <small class="logo-slogan">Online Job and Project collaboration Portal</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center ms-lg-5">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About Portfolify</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                        <li><a class="dropdown-item" href="job-listings.php">Job Listings</a></li>
                        <li><a class="dropdown-item" href="project-listing.php">Project Listings</a></li>
                    </ul>
                </li>

                <?php

                include_once 'auth.php';
                
                if (isset($_SESSION['email'])) {
                    // User is logged in
                    echo '
                        <li class="nav-item ms-lg-auto">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-btn btn" href="Sign_Out.php">Logout</a>
                        </li>
                    ';
                } else {
                    // User is not logged in
                    echo '
                        <li class="nav-item ms-lg-auto">
                            <a class="nav-link" href="Sign_Up.html">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link custom-btn btn" href="Sign_In.php">Login</a>
                        </li>
                    ';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

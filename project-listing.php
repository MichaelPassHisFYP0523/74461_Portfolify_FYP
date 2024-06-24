<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolify Project Listing</title>
    <!-- CSS FILES -->
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/owl.theme.default.min.css" rel="stylesheet">
    <link href="css/tooplate-gotto-job.css" rel="stylesheet">
</head>
<body class="job-listings-page" id="top">

<?php include 'navbar.php'; ?>

<main>
    <header class="site-header">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <h1 class="text-white">Project Listings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project listings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="section-padding pb-0 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <form class="custom-form hero-form" action="javascript:void(0);" method="get" role="form">
                        <h3 class="text-white mb-3">Search your dream project</h3>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi-person custom-icon"></i></span>
                                    <input type="text" name="job-title" id="job-title" class="form-control" placeholder="Project Title" onkeyup="showResult(this.value)">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi-laptop custom-icon"></i></span>
                                        <select name="industry" id="industry" class="form-control" onchange="showResult(document.getElementById('job-title').value, this.value)">
                                            <option value="" disabled selected>Choose Your Field</option>
                                            <option value="Information Technology (IT)">Information Technology (IT)</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Education">Education</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Sales and Marketing">Sales and Marketing</option>
                                            <option value="Human Resources">Human Resources</option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Retail">Retail</option>
                                            <option value="Hospitality and Tourism">Hospitality and Tourism</option>
                                            <option value="Others">Others</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-12">
                    <img src="images/4557388.png" class="hero-image img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="job-section section-padding">
        <div class="container">
            <div class="col-lg-12 col-12">
                <h2 class="text-center mb-4">Projects Available</h2> 
            </div>
            <div class="row" id="project-list">
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>
<script>
function showResult(title, industry) {
    if (title.length == 0 && !industry) {
        document.getElementById("project-list").innerHTML = "";
        loadAllProjects(); // Load all projects when search box is empty
        return;
    }
    var query = "q=" + title;
    if (industry) {
        query += "&industry=" + industry;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("project-list").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "livesearch.php?" + query, true);
    xmlhttp.send();
}

function loadAllProjects() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("project-list").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "livesearch.php?q=&industry=", true); // Empty query to load all projects
    xmlhttp.send();
}

// Load all projects initially
document.addEventListener("DOMContentLoaded", function() {
    loadAllProjects();
});

</script>
</body>
</html>

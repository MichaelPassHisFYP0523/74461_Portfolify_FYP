<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolify</title>
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
                    <h1 class="text-white">User Listings</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User listings</li>
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
                        <h3 class="text-white mb-3">Search user</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi-person custom-icon"></i></span>
                                    <input type="text" name="education" id="education" class="form-control" placeholder="Education" onkeyup="showResult(this.value)">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi-geo-alt custom-icon"></i></span>
                                    <input type="text" name="job-location" id="job-location" class="form-control" placeholder="Location" onkeyup="showResult(this.value)">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi-cash custom-icon"></i></span>
                                    <select class="form-select form-control" name="job-salary" id="job-salary" aria-label="Default select example" onchange="showResult()">
                                        <option selected>Salary Range</option>
                                        <option value="1">RM0-RM3000</option>
                                        <option value="2">RM3000-RM10k</option>
                                        <option value="3">>RM10k</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi-laptop custom-icon"></i></span>
                                    <select class="form-select form-control" name="job-type" id="job-type" aria-label="Default select example" onchange="showResult()">
                                        <option selected>Work Types</option>
                                        <option value="1">Now</option>
                                            <option value="2">2 weeks</option>
                                            <option value="4">4 weeks</option>
                                            <option value="8">8 weeks</option>
                                            <option value="12">12 weeks</option>
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
                <h2 class="text-center mb-4">Result</h2> 
            </div>
            <div class="row" id="user-list">
        
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
function showResult() {
    var education = document.getElementById('education').value;
    var jobLocation = document.getElementById('job-location').value;
    var jobSalary = document.getElementById('job-salary').value;
    var jobType = document.getElementById('job-type').value;
    
    var params = "education=" + education + "&jobLocation=" + jobLocation + "&jobSalary=" + jobSalary + "&jobType=" + jobType;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("user-list").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "live_search.php?" + params, true);
    xmlhttp.send();
}

// Load all projects initially
document.addEventListener("DOMContentLoaded", function() {
    showResult();
});
</script>
</body>
</html>

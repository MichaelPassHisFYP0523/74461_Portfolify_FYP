<?php

    include 'auth.php';
    include 'con.php';

    checkLogin();

    $email = $_SESSION['email'];

    $user_id = $_SESSION['user_id'];

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolify Profile</title>


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

        <!-- Navigation Bar -->
        <?php include 'navbar.php'; ?>
        <!-- End Navbar -->

        <main>

        <header class="site-header">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">My Project</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Project Management</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </header>

            <!-- Projects Section -->
            <section class="projects-section section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <h2>My Projects</h2>
                            <div class="row mb-4">
                                <div class="col-lg-12 col-12 text-center">
                                    <a href="project_invite.php" class="btn btn-secondary">Collaboration Invite</a>
                                    <a href="#upload-section" class="btn btn-primary">Add Project</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // Fetch projects associated with the user
                        $project_query = "SELECT * FROM projects WHERE `user_id` = '$user_id'";
                        $project_result = $conn->query($project_query);

                        if ($project_result->num_rows > 0) {
                            while ($project_row = $project_result->fetch_assoc()) {
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="card h-100"> 
                                        <img src="<?php echo $project_row['project_image']; ?>" class="card-img-top" alt="Project Image">
                                        <div class="card-body d-flex flex-column"> 
                                            <h5 class="card-title"><?php echo $project_row['title']; ?></h5>
                                            <div class="mt-auto">
                                                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProjectModal"  
                                                data-project-id="<?php echo $project_row['project_id']; ?>"
                                                data-project-title="<?php echo $project_row['title']; ?>"
                                                data-project-description="<?php echo $project_row['description']; ?>"
                                                data-project-image="<?php echo $project_row['project_image']; ?>" 
                                                data-project-file=<?php echo $project_row['project_path'];?> >Edit</a>
                                                <button type="button" class="btn btn-danger" onclick="deleteProject('<?php echo $project_row['project_id']; ?>')">Delete</button>
                                            </div> 
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

            <!-- Upload project -->
            <section id="upload-section" class="cta-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12 mx-auto">
                            <form class="custom-form contact-form" id="uploadForm" method="post" enctype="multipart/form-data">
                                <h2 class="text-center mb-4">Upload your project</h2>

                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <label for="full-name">Title</label>
                                        <input type="text" name="full_name" id="full-name" class="form-control" placeholder="Development of ..." required >
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="file">Upload your file</label>
                                        <input type="file" name="file" id="file" class="form-control" required data-toggle="tooltip" title="Upload the main file of your project">
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="desc">Describe your project</label>
                                        <textarea name="description" id="desc" rows="6" class="form-control" placeholder="This project is about ..." required></textarea>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <label for="industry">Industries</label>
                                        <select name="industry" id="industry" class="form-control" required>
                                            <option value="" disabled selected>Choose One</option>
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

                                    <div class="col-lg-12 col-12">
                                        <label for="image_file">Project image (Optional)</label>
                                        <input type="file" name="image_file" id="image_file" class="form-control" accept="image/*" data-toggle="tooltip" title="Upload an optional image related to your project">
                                    </div>

                                    <!-- Hidden input field to store the user_id -->
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                    
                                    <!-- Store the action -->
                                    <input type="hidden" name="action" value="upload">

                                    <!-- Collaboration preference -->
                                    <div class="col-lg-12 col-12">
                                        <label>Collaborate?</label><br>
                                        <input type="radio" name="collaborate" value="1" id="collaborate-yes" title="Select 'Yes' if you are open to collaboration">
                                        <label for="collaborate-yes">Yes</label>
                                        <input type="radio" name="collaborate" value="0" id="collaborate-no" title="Select 'No' if you do not want to collaborate">
                                        <label for="collaborate-no">No</label>
                                    </div>


                                    <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                        <button type="button" onclick="uploadProject()" class="form-control" >Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Edit Project Modal -->
            <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editProjectForm">
                                <div class="col-md-12 mb-3">
                                    <label for="edit-title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="edit-title" name="title" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="edit-description" class="form-label">Description</label>
                                    <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="edit-proj-file" class="form-label">Project File</label>
                                    <input type="file" class="form-control" id="edit-proj-file" name="proj_file">
                                    <a id="current-project-file" href="#" target="_blank" class="ms-2">View Current File</a>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="edit-image-file" class="form-label">Project Image (Optional)</label>
                                    <input type="file" class="form-control" id="edit-image-file" name="image_file" accept="image/*">
                                </div>
                                <input type="hidden" id="edit-project-id" name="project_id">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            </main>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-12 d-flex align-items-center">

                            <ul class="footer-menu d-flex">
                                <li class="footer-menu-item"><a href="#" class="footer-menu-link">Privacy Policy</a></li>

                                <li class="footer-menu-item"><a href="#" class="footer-menu-link">Terms</a></li>
                            </ul>
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

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

        <!-- Popper.js -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> -->

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <script>
            // Display the data in modal
            document.addEventListener('DOMContentLoaded', function() {
                var editProjectModal = document.getElementById('editProjectModal');
                
                editProjectModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget; 
                    var projectId = button.getAttribute('data-project-id');
                    var projectTitle = button.getAttribute('data-project-title');
                    var projectDescription = button.getAttribute('data-project-description');
                    var projectFile = button.getAttribute('data-project-file');

                    // Update the modal's content with project data
                    var modalTitleInput = editProjectModal.querySelector('#edit-title');
                    var modalDescriptionTextarea = editProjectModal.querySelector('#edit-description');
                    var modalProjectIdInput = editProjectModal.querySelector('#edit-project-id');
                    var modalImagePreview = editProjectModal.querySelector('#edit-project-image-preview');
                    var modalProjectFileLink = editProjectModal.querySelector('#current-project-file');

                    modalTitleInput.value = projectTitle;
                    modalDescriptionTextarea.value = projectDescription;
                    modalProjectIdInput.value = projectId;
                    modalProjectFileLink.href = projectFile;
                    modalProjectFileLink.textContent = projectFile ? 'View Current File' : 'No File';
                });
            });

            // Edit the project
            document.getElementById('editProjectForm').addEventListener('submit', function(event) {
                event.preventDefault();
                
                var formData = new FormData(this);
                formData.append('action', 'edit');  

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "project_actions.php", true);
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload(); 
                    } else {
                        alert('Error: ' + xhr.statusText);
                    }
                };
                xhr.send(formData);
            });

            // Upload a project
            function uploadProject() {
                
                var formData = new FormData(document.getElementById('uploadForm'));

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "project_actions.php", true);
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload();
                    }
                };
                xhr.send(formData);
            }

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

            // Delete the project
            function deleteProject(projectId) {
                if (confirm('Are you sure you want to delete this project?')) {
                    $.ajax({
                        url: 'project_actions.php',
                        type: 'POST',
                        data: { action: 'delete', project_id: projectId },
                        success: function(response) {
                            if (response == 'success') {
                                $('#project-' + projectId).remove();
                                alert('Project deleted successfully.');
                                location.reload();
                            } else {
                                alert('Error deleting project: ' + response);
                            }
                        }
                    });
                }
            }

        </script>


<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    ob_end_flush();
    exit;
}

// Check if the request is not coming from your system
if (empty($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'localhost/iprms') === false) {
    header("Location: index.php");
    exit;
}
include 'includes/conn.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>IPRMS Dashboard</title>
    <link rel="icon" class="rounded-circle" href="assets/images/logo.png" type="image/png">

    <!-- Bootstrap CSS -->
    <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <style>
    .con {
        height: 70vh;
    }

    .img {
        width: 25%;
        height: 25%;
        margin: 30px auto;
    }

    span {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    p {
        margin-top: -4%;
        font-size: 20px;
    }

    hr {
        margin-top: 13%;
    }
    </style>
</head>

<body class='bg-light'>
    <div class='d-flex vh-100 vw-100 overflow-hidden'>
        <?php
        include 'includes/sidebar.php';
        ?>

        <div class='flex-grow-1 overflow-auto'>
            <?php
            include 'includes/header.php';
            ?>

            <div class='p-4'>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-success card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center mt-3">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="assets/images/undraw_profile.svg" alt="User profile picture">
                                        </div>

                                        <?php
                                        // Start PHP block to fetch user profile data
                                        $id = $_SESSION['u_id'];
                                        $selectData = $conn->prepare("SELECT * FROM users WHERE u_id = ?");
                                        $selectData->execute([$id]);

                                        foreach ($selectData as $data) {
                                            ?>
                                        <h3 class="profile-username text-center my-3">
                                            <?= $data['u_fname'] ?>
                                            <?= $data['u_lname'] ?>
                                        </h3>
                                        <center>
                                            <small class="text-muted text-center">
                                                <?= $data['u_email'] ?>
                                            </small>
                                        </center>
                                        <div class="my-3 bordered">
                                            <ul class="nav nav-pills justify-content-evenly">
                                                <li class="nav-item">
                                                    <a id="pill" class="nav-link btn btn-success" href="#edit-profile"
                                                        data-toggle="tab">
                                                        <i class="fas fa-user-edit mr-2"></i>Edit
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a id="pill" class="nav-link" href="#change-password"
                                                        data-toggle="tab">
                                                        <i class="fas fa-key mr-2"></i>Change
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a id="pill" class="nav-link btn btn-success" href="#edit-profile"
                                                    data-toggle="tab">
                                                    <i class="fas fa-user-edit mr-2"></i>Edit Profile
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="pill" class="nav-link" href="#change-password" data-toggle="tab">
                                                    <i class="fas fa-key mr-2"></i>Change Password
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane" id="edit-profile">
                                                <?php
                                                $id = $_SESSION['u_id'];
                                                $selectData = $conn->prepare("SELECT * FROM users WHERE u_id = ?");
                                                $selectData->execute([$id]);

                                                foreach ($selectData as $data) { ?>
                                                <form action="process.php" method="post" class="p-3">
                                                    <div class="mb-3">
                                                        <label for="fname">Firstname</label>
                                                        <input type="text" id="fname" class="form-control" name="fname"
                                                            value="<?= $data['u_fname'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lname">Lastname</label>
                                                        <input type="text" id="lname" class="form-control" name="lname"
                                                            value="<?= $data['u_lname'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control"
                                                            value="<?= $data['u_email'] ?>">
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-5">
                                                    <button type="submit" class="btn btn-secondary me-2">Close</button>
                                                        <button type="submit" name="e-user"
                                                            class="btn btn-success">Submit Changes</button>
                                                    </div>
                                                </form>
                                                <?php
                                                } ?>
                                            </div>
                                            <div class="tab-pane" id="change-password">
                                                <?php
                                                $id = $_SESSION['u_id'];
                                                $selectData = $conn->prepare("SELECT * FROM users WHERE u_id = ?");
                                                $selectData->execute([$id]);

                                                foreach ($selectData as $data) { ?>
                                                <form action="process.php" method="post" class="p-3">
                                                    <div class="mb-3">
                                                        <label for="pass1">New Password</label>
                                                        <input type="password" name="pass1" for="pass1"
                                                            class="form-control">
                                                        <input type="hidden" name="pass" id="pass1" class="form-control"
                                                            value="<?= $data['u_pass'] ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pass2">Confirm Password</label>
                                                        <input type="password" name="pass2" id="pass2"
                                                            class="form-control">
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-5">
                                                        <button type="submit" class="btn btn-secondary me-2">Close</button>
                                                        <button type="submit" name="c-psswrd"
                                                            class="btn btn-primary">Change Password</button>
                                                    </div>
                                                </form>
                                                <?php
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE JS -->
    <script src="assets/js/adminlte.min.js"></script>

    <script>
    $(document).ready(function() {
        // Handle click on nav pills
        $('ul.nav-pills #pill').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
    </script>
</body>

</html>
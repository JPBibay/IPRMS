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
$userID = $_SESSION['u_id'];

// SQL query to get the counts
$query = "
    SELECT 
        COUNT(*) as total_population,
        SUM(gender = 'male') as total_male,
        SUM(gender = 'female') as total_female,
        SUM(ip_scholar = 'IP Scholar') as ip_scholars,
        SUM(ip_youth = 'IP Youth') as ip_youth,
        SUM(ip_women = 'IP Women') as ip_women,
        SUM(pwd = 'PWD') as pwd,
        SUM(senior_citizen = 'Senior Citizen') as senior_citizens
    FROM ip_records
    WHERE user_id = ?
";
$select = $conn->prepare($query);
$select->execute([$userID]);
$totals = $select->fetch(PDO::FETCH_ASSOC);

// SQL query to count purok
$query = "
    SELECT 
        COUNT(*) as total_purok
    FROM purok
    WHERE user_id = ?
";
$select = $conn->prepare($query);
$select->execute([$userID]);
$purok = $select->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>IPRMS Dashboard</title>
    <link rel="icon" class="rounded-circle" href="assets/images/logo.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
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
            <?php include 'includes/sweetmessage.php'; ?>
            <div class='p-4'>
                <div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-4 gy-2'>
                    <!-- Total Population -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?total" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-success">
                                <div class="inner">
                                    <h3><?= $totals['total_population']; ?></h3>
                                    <p>Total Population</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- Total Male -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?male" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-secondary">
                                <div class="inner">
                                    <h3><?= $totals['total_male']; ?></h3>
                                    <p>Total Male</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-male"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- Total Female -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?female" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-primary">
                                <div class="inner text-white">
                                    <h3><?= $totals['total_female']; ?></h3>
                                    <p>Total Female</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-female"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- IP Scholars -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?ip_scholar" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-dark">
                                <div class="inner">
                                    <h3><?= $totals['ip_scholars']; ?></h3>
                                    <p>IP Scholars</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- IP Youth -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?ip_youth" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-dark">
                                <div class="inner">
                                    <h3><?= $totals['ip_youth']; ?></h3>
                                    <p>IP Youth</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-child"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- IP Women -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?ip_women" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-primary">
                                <div class="inner">
                                    <h3><?= $totals['ip_women']; ?></h3>
                                    <p>IP Women</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-female"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- PWD -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?pwd" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-success">
                                <div class="inner">
                                    <h3><?= $totals['pwd']; ?></h3>
                                    <p>PWD</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wheelchair"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- Senior Citizens -->
                    <div class="col-lg-3 col-6">
                        <a href="record.php?senior_citizen" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-secondary">
                                <div class="inner">
                                    <h3><?= $totals['senior_citizens']; ?></h3>
                                    <p>Senior Citizens</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-blind"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <!-- Purok -->
                    <div class="col-lg-3 col-6">
                        <a href="purok.php" style="text-decoration:none">
                            <div class="small-box bg-gradient bg-success">
                                <div class="inner">
                                    <h3><?= $purok['total_purok']; ?></h3>
                                    <p>Purok</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <span class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE JS -->
    <script src="assets/js/adminlte.min.js"></script>
</body>

</html>
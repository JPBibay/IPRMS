<!-- Bootstrap CSS -->
<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="assets/css/all.min.css">

<!-- Bootstrap CSS -->
<script src='bootstrap/js/bootstrap.bundle.min.js'></script>

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href='/css/boxicons.min.css' rel='stylesheet'>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

* {
    font-family: 'Poppins', sans-serif;
}
</style>

<?php
    include 'includes/conn.php';
    $userID = $_SESSION['u_id'];
    $cnt = 1;
    $select = $conn->prepare("SELECT * FROM users WHERE u_id = ?");
    $select->execute([$userID]);
    foreach ($select as $data) { ?>

<header class="d-flex justify-content-between align-items-center p-4 bg-white shadow-sm" style="height:70px;">
    <div class="text-lg font-semibold">
        <a class="mobile_btn text-success" id="mobile_btn"><strong><i class="fa-solid fa-bars"></i></strong></a>
    </div>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="assets/images/undraw_profile.svg" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-light text-small shadow">
            <li>
                <a class="dropdown-item" href="profile.php">
                    <i class="fas fa-user me-2"></i> Profile
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="Settings.php">
                    <i class="fas fa-cog me-2"></i> Settings
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="process.php?logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Sign out
                </a>
            </li>
        </ul>
    </div>

</header>

<?php } ?>
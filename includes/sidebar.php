<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<style>
.sidebar-collapsed {
    width: 6rem !important;
    transition: width 0.3s;
}

.sidebar-expanded {
    width: 280px !important;
    transition: width 0.3s;
}

.sidebar-collapsed .nav-link span {
    display: none;
}

.sidebar-collapsed .submenu {
    display: none;
}

.sidebar-collapsed .nav-link {
    justify-content: center;
}

.sidebar-collapsed .nav-link i {
    font-size: 1.5rem;
}

.sidebar-collapsed .square-div h3 {
    display: none;
}

.sidebar-collapsed .custom-caret {
    display: none !important;
}

.sidebar-collapsed .custom-menu {
    margin-right: 15px;
}

.sidebar-collapsed .custom-hr {
    margin-bottom: 50px;
}

.sidebar-collapsed .square-div img {
    width: 100px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.sidebar-expanded .square-div img {
    width: 170px;
    height: 170px;
    border-radius: 50%;
}

.nav-link-custom.active {
    background-color: black !important;
    color: white !important;
}
</style>

<div id="sidebar" class="d-flex flex-column flex-shrink-0 bg-success bg-gradient sidebar-expanded shadow"
    style="height: 100vh;">
    <div class="square-div p-4 text-center">
        <div class="d-flex justify-content-center align-items-center overflow-hidden">
            <img src="assets/images/logo.png" class="rounded-circle img-fluid" alt="">
        </div>
        <h3 class="text-center text-light mt-3 fs-2"><strong>IPRMS</strong></h3>
    </div>
    <hr class="mb-4">
    <div class="px-3">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item custom-menu">
                <a href="index.php" class="nav-link nav-link-custom btn btn-dark text-white d-flex align-items-center"
                    id="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="flex-grow-1 ms-2 text-start">Dashboard</span>
                </a>
            </li>
            <li class="nav-item custom-menu">
                <a href="record.php?total"
                    class="nav-link nav-link-custom btn btn-dark text-white d-flex align-items-center" id="members">
                    <i class="fas fa-users"></i>
                    <span class="flex-grow-1 ms-2 text-start">IP Members</span>
                </a>
            </li>
            <li class="nav-item custom-menu">
                <a href="forms.php" class="nav-link nav-link-custom btn btn-dark text-white d-flex align-items-center"
                    id="forms">
                    <i class="fas fa-file-alt"></i>
                    <span class="flex-grow-1 ms-2 text-start">Certificates & Forms</span>
                </a>
            </li>
            <li class="nav-item has-submenu custom-menu">
                <a class="nav-link nav-link-custom text-decoration-none text-white" href="purok.php" id="purok">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span class="flex-grow-1 ms-2 text-start">Purok</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#mobile_btn').on('click', function() {
        $('#sidebar').toggleClass('sidebar-expanded sidebar-collapsed');
    });

    // Set active class based on URL
    const currentUrl = window.location.pathname;
    const navLinks = {
        '/index.php': '#dashboard',
        '/record.php': '#members',
        '/forms.php': '#forms',
        '/purok.php': '#purok',
        '/population.php': '#population',
        '/household.php': '#household'
    };

    Object.keys(navLinks).forEach(path => {
        if (currentUrl.includes(path)) {
            $(navLinks[path]).addClass('active');
        }
    });
});
</script>
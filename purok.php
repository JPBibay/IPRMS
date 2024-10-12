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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Records</title>
    <link rel="icon" class="rounded-circle" href="assets/images/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
</head>

<body class="bg-light">
    <div class="d-flex vh-100">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-grow-1 overflow-auto">
            <?php include 'includes/header.php'; ?>

            <div class="container mt-2">

                <?php include 'includes/sweetmessage.php'; ?>

                <div class="card w-100 my-2" style="width:100%;">
                    <div class="row justify-content-center">
                        <h4 class="my-3 text-center text-success"><strong>Barangay Oringao Total Sitio/Purok</strong>
                        </h4>
                        <div class="col-12">
                            <!-- Button to add new Purok record -->
                            <div class="d-flex justify-content-between ms-3 my-3">
                                <button type="button" class="btn btn-success active rounded-5" data-bs-toggle="modal"
                                    data-bs-target="#addPurok">
                                    <i class="fa fa-plus text-white"></i> Add Purok
                                </button>
                            </div>
                            <div class="card-body">
                                <!-- Table to display Purok records -->
                                <table id="MyTable" class="table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Purok</th>
                                            <th>Population</th>
                                            <th>Household</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                        include 'includes/conn.php';
                        $userID = $_SESSION['u_id'];
                        $cnt = 1;

                        $select = $conn->prepare("
                            SELECT p.id, p.purok, p.household, 
                                COALESCE(COUNT(ir.purok_id), 0) as total_records
                            FROM purok p
                            LEFT JOIN ip_records ir ON p.id = ir.purok_id
                            WHERE p.user_id = ?
                            GROUP BY p.id, p.purok, p.household
                            ORDER BY p.purok ASC
                        ");

                        $select->execute([$userID]);
                        foreach ($select as $data) {
                            ?>
                                        <tr>
                                            <td><?= $cnt++ ?></td>
                                            <td><?= $data['purok'] ?></td>
                                            <td><?= $data['total_records'] ?></td>
                                            <td><?= $data['household'] ?></td>
                                            <td class="text-center">
                                                <!-- Dropdown menu for actions -->
                                                <div class="dropdown">
                                                    <button class="btn text-success" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="population.php?id=<?= $data['id'] ?>"><i
                                                                    class="fa-solid fa-eye text-success"></i> View</a>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#editModal<?= $data['id'] ?>">
                                                                <i class="fa fa-pen-to-square text-warning"></i> Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal<?= $data['id'] ?>">
                                                                <i class="fa fa-trash-can text-danger"></i> Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php include 'includes/purok_modals.php';
                        } ?>
                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <?php include 'includes/purok_modals.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- JavaScript and jQuery libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>

    <!-- Initialize DataTables and custom scripts -->
    <script>
    $(document).ready(function() {
        $('#MyTable').DataTable();
    });
    </script>
</body>

</html>
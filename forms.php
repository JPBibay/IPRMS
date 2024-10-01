<?php
session_start();

// Check if the request is not coming from your system
if (empty($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'localhost/iprms') === false) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
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

                <div class="row justify-content-center">
                    <h3 class="my-3 text-center text-success"><strong>Forms & Certificates</strong></h3>
                    <div class="col-12">
                        <!-- Button to add new Form/Certificate record -->
                        <div class="d-flex justify-content-between ms-1 my-3">
                            <button type="button" class="btn btn-success active rounded-5" data-bs-toggle="modal"
                                data-bs-target="#addForm">
                                <i class="fa fa-plus text-white"></i> Add File
                            </button>
                        </div>

                        <!-- Table to display Form/Certificate records -->
                        <table id="MyTable" class="table table-striped table-bordered w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>File Name</th>
                                    <th>File Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'includes/conn.php';
                                $userID = $_SESSION['u_id'];
                                $cnt = 1;

                                $select = $conn->prepare("SELECT * FROM forms WHERE user_id = ?");
                                $select->execute([$userID]);

                                foreach ($select as $data) {
                                    $fileExtension = pathinfo($data['file_name'], PATHINFO_EXTENSION);
                                    $isPDF = strtolower($fileExtension) === 'pdf';
                                    ?>

                                <tr>
                                    <td><?= $cnt++ ?></td>
                                    <td><?= $data['file_name'] ?></td>
                                    <td><?= strtoupper($fileExtension) ?></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn text-success" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="files/download.php?id=<?= $data['id'] ?>">
                                                        <i class="fa fa-download text-primary"></i> Save
                                                    </a>
                                                </li>
                                                <?php if ($isPDF): ?>
                                                <li>
                                                    <button class="dropdown-item"
                                                        onclick="printFile(<?= $data['id'] ?>)">
                                                        <i class="fa fa-print text-success"></i> Print
                                                    </button>
                                                </li>
                                                <?php endif; ?>
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

                                <?php include 'includes/forms_modals.php';
                                } ?>
                            </tbody>
                        </table>

                        <?php
                        include 'includes/forms_modals.php';
                        ?>
                        <a class="btn btn-primary" href='index.php'><i class="fa-solid fa-arrow-left"></i></a>
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
    <script>
    function printFile(id) {
        fetch(`files/print.php?id=${id}`)
            .then(response => response.blob())
            .then(blob => {
                const url = URL.createObjectURL(blob);
                const printWindow = window.open(url, '_blank');
                printWindow.onload = () => {
                    printWindow.print();
                    URL.revokeObjectURL(url);
                };
            });
    }
    </script>


</body>

</html>
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Records</title>
    <link rel="icon" class="rounded-circle" href="assets/images/logo.png" type="image/png">
    <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/datatables.min.css">
</head>

<body class='bg-light'>
    <div class='d-flex vh-100 vw-100 overflow-hidden'>
        <?php include 'includes/sidebar.php'; ?>

        <div class='flex-grow-1 overflow-auto'>
            <?php include 'includes/header.php'; ?>

            <div class="row mt-2 justify-content-center">
                <div class="col me-2 ms-2">

                    <?php include 'includes/sweetmessage.php'; ?>

                    <div class="row justify-content-center">
                        <?php
                        if (isset($_GET['total'])) {
                            ?>
                            <div class="col-12">
                                <h4 class="my-3 text-center text-success"><strong>IP Members</strong></h4>
                                <div class="d-flex justify-content-start my-3 w-100">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                    <button type="button" class="btn btn-success align-end btn-custom ms-2 rounded-3"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-print text-white"></i>
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                    <?= $data['sc_pensioner'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>

                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['male'])) {
                            ?>
                            <div class="col-12">
                                <h4 class="my-3 text-center text-success"><strong>IP Total Male</strong></h4>
                                <div class="d-flex justify-content-start my-3">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? AND gender = 'male' ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                    <?= $data['sc_pensioner'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['female'])) {
                            ?>
                            <div class="col-12">
                                <h4 class="my-3 text-center text-success"><strong>IP Total Female</strong></h4>
                                <div class="d-flex justify-content-start my-3">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? AND gender = 'female' ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                    <?= $data['sc_pensioner'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['ip_scholar'])) {
                            ?>
                            <div class="col-12">
                                <h4 class="my-3 text-center text-success"><strong>IP Scholars</strong></h4>
                                <div class="d-flex justify-content-start my-3">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? AND ip_scholar = 'IP Scholar' ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                    <?= $data['sc_pensioner'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['ip_youth'])) {
                            ?>
                            <div class="col-12 ">
                                <h4 class="my-3 text-center text-success"><strong>IP Youth</strong></h4>
                                <div class="d-flex justify-content-start my-3">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? AND ip_youth = 'IP Youth' ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                    <?= $data['sc_pensioner'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['ip_women'])) {
                            ?>
                            <div class="col-12">
                                <h4 class="my-3 text-center text-success"><strong>IP Women</strong></h4>
                                <div class="d-flex justify-content-start my-3">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? AND ip_women = 'IP Women' ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                    <?= $data['sc_pensioner'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['pwd'])) {
                            ?>
                            <div class="col-12">
                                <h4 class="my-3 text-center text-success"><strong>Person with Disability(PWD)</strong></h4>
                                <div class="d-flex justify-content-start my-3">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? AND pwd = 'PWD' ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                    <?= $data['sc_pensioner'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['senior_citizen'])) {
                            ?>
                            <div class="col-12">
                                <h4 class="my-3 text-center text-success"><strong>Senior Citizen</strong></h4>
                                <div class="d-flex justify-content-start my-3">
                                    <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#addRecord">
                                        <i class="fa fa-plus text-white"></i> Add Member
                                    </button>
                                    <button type="button" class="btn btn-success btn-custom ms-2 rounded-5"
                                        data-bs-toggle="modal" data-bs-target="#addcsv">
                                        <i class="fa fa-plus text-white"></i> Add CSV
                                    </button>
                                </div>

                                <table id="MyTable" class="shadow-sm table table-striped table-bordered w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Pensioner</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                            <th class="d-none">Hidden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'includes/conn.php';
                                        $userID = $_SESSION['u_id'];
                                        $cnt = 1;
                                        $select = $conn->prepare("SELECT * FROM ip_records WHERE user_id = ? AND senior_citizen = 'Senior Citizen' ORDER BY lname ASC");
                                        $select->execute([$userID]);
                                        foreach ($select as $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $cnt++ ?></td>
                                                <td>
                                                    <?= $data['lname'] ?>, <?= $data['fname'] ?>
                                                    <?= substr($data['mname'], 0, 1) ?>.
                                                </td>
                                                <td><?= $data['gender'] ?></td>
                                                <td><?= $data['age'] ?></td>
                                                <td><?= $data['sc_pensioner'] ?></td>
                                                <td><?= $data['purok'] ?>, Brgy.<?= $data['barangay'] ?>, <?= $data['city'] ?>,
                                                    <?= $data['province'] ?>
                                                </td>
                                                <td><?= $data['contact_no'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-success action-icon dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Manage
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?= $data['id'] ?>"><i
                                                                        class="fa-solid fa-eye text-success"></i> View
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-pen-to-square text-warning"></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal<?= $data['id'] ?>"><i
                                                                        class="fa-regular fa-trash-can text-danger"></i> Delete
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="d-none">
                                                    <?= $data['birthday'] ?>
                                                    <?= $data['status'] ?>
                                                    <?= $data['occupation'] ?>
                                                    <?= $data['school_level'] ?>
                                                    <?= $data['ip_scholar'] ?>
                                                    <?= $data['ip_youth'] ?>
                                                    <?= $data['ip_women'] ?>
                                                    <?= $data['pwd'] ?>
                                                    <?= $data['senior_citizen'] ?>
                                                </td>
                                            </tr>

                                            <!--Edit, View, Delete Modals-->
                                            <?php include 'includes/record_modals.php';
                                        } ?>

                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href='index.php'>
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <!--Add Modal-->
                                <?php include 'includes/add_record_modal.php'; ?>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>

    <script>
        $(document).ready(function () {
            $('#MyTable').DataTable();
        });
    </script>

</body>
 
</html>
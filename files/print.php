<?php
include '../includes/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT file_name, file FROM forms WHERE id = ?");
    $query->execute([$id]);
    $file = $query->fetch(PDO::FETCH_ASSOC);

    if ($file) {
        $fileExtension = pathinfo($file['file_name'], PATHINFO_EXTENSION);
        $fileName = $file['file_name'];
        $fileContent = $file['file'];

        if ($fileExtension == 'pdf') {
            header('Content-Type: application/pdf');
            header("Content-Disposition: inline; filename=\"$fileName\"");
            echo $fileContent;
        } elseif ($fileExtension == 'docx') {
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            echo $fileContent;
        }
        exit;
    }
}
?>

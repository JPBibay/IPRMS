<?php
include '../includes/conn.php';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $query = $conn->prepare("SELECT file_name, file FROM forms WHERE id = ?");
    $query->execute([$id]);
    $file = $query->fetch(PDO::FETCH_ASSOC);

    if ($file) {
        $fileName = $file['file_name'];
        $fileData = $file['file'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Set headers to force download
        if ($fileExtension === 'pdf') {
            header('Content-Type: application/pdf');
        } elseif ($fileExtension === 'docx') {
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        } else {
            header('Content-Type: application/octet-stream');
        }

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($fileData));

        echo $fileData;
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>

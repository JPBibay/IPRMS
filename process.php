<?php
include 'includes/conn.php';

// Register a user
if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    // Check if passwords match
    if ($pass1 === $pass2) {
        // Check if email already exists
        $checkEmail = $conn->prepare('SELECT * FROM users WHERE u_email = ?');
        $checkEmail->execute([$email]);

        if ($checkEmail->rowCount() > 0) {
            // Email already exists
            $alrt = "Email is already registered!";
            header("Location: register.php?alrt=$alrt");
            exit;
        } else {
            // Proceed with registration
            $hash = password_hash($pass1, PASSWORD_DEFAULT);
            $addUser = $conn->prepare('INSERT INTO users(u_fname, u_lname, u_email, u_pass) VALUES(?, ?, ?, ?)');
            $addUser->execute([$fname, $lname, $email, $hash]);

            $newUserId = $conn->lastInsertId();

            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['u_id'] = $newUserId;

            header('Location: index.php');
            exit;
        }
    } else {
        $alrt = "Passwords do not match!";
        header("Location: register.php?alrt=$alrt");
        exit;
    }
}

// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $conn->prepare('SELECT * FROM users WHERE u_email = ?');
    $check->execute([$email]);

    $data = $check->fetch();

    if ($data && password_verify($password, $data['u_pass'])) {
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['u_id'] = $data['u_id'];

        header('Location: index.php');
        exit;
    } else {
        $alrt = 'Email or Password do not match!';
        header("Location: login.php?alrt=$alrt");
        exit;
    }
}

//edit user
if (isset($_POST['e-user'])) {
    session_start();
    $id = $_SESSION['u_id'];
 
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
 
    // UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;
    $update = $conn->prepare("UPDATE users SET u_fname = ?, u_lname = ?,  u_email = ? WHERE u_id = ?");
    $update->execute([
       $fname,
       $lname,
       $email,
       $id
    ]);
 
    $msg = "Profile Updated!";
    header("Location: profile.php?msg=$msg");
 }
 
 // Change password
 if (isset($_POST['c-psswrd'])) {
    session_start(); 
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
 
    if ($pass1 == $pass2) {
       // Hash the new password
       $hash = password_hash($pass1, PASSWORD_DEFAULT);
 
       // Update password in the database
       $id = $_SESSION['u_id'];
       $update = $conn->prepare("UPDATE users SET u_pass = ? WHERE u_id = ?");
       $update->execute([$hash, $id]);
 
       $msg = "Password Updated!";
       header("Location: profile.php?msg=$msg");
       exit;
    } else {
       $alrt = "Passwords do not match!";
       header("Location: profile.php?msg=$msg");
       exit;
    }
 }

// Logout
if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['logged_in']);
    unset($_SESSION['u_id']);

    header('Location: login.php');
}


// Create Records
if (isset($_POST['add-record'])) {
    $uID = $_POST['u-ID'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $bday = $_POST['birthday'];
    $status = $_POST['status'];
    $contact = $_POST['contact'];
    $purok = $_POST['purok'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $spouse = $_POST['spouse'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $occupation = $_POST['occupation'];
    $school_level = $_POST['school'];
    $tribe = $_POST['tribe'];
    $ip_scholar = isset($_POST['ip_scholar']) ? "IP Scholar" : "N/A";
    $ip_youth = isset($_POST['ip_youth']) ? "IP Youth" : "N/A";
    $ip_women = isset($_POST['ip_women']) ? "IP Women" : "N/A";
    $pwd = isset($_POST['pwd']) ? "PWD" : "";
    $senior_C = isset($_POST['senior_C']) ? "Senior Citizen" : "N/A";
    $SC_pensioner = isset($_POST['SC_pensioner']) ? "Pensioner" : "N/A";


    // Check if the purok exists in the database
    $check = $conn->prepare('SELECT * FROM purok WHERE purok = ?');
    $check->execute([$purok]);
    $data = $check->fetch();

    if ($data) {
        $purok_id = $data['id'];
    } else {
        $purok_id = null;
    }

    $insert = $conn->prepare('INSERT INTO ip_records(user_id, fname, mname, lname, gender, age, birthday, status, contact_no, purok, purok_id, barangay, city, province, spouse, father, mother, occupation, school_level, tribe, ip_scholar, ip_youth, ip_women, pwd, senior_citizen, sc_pensioner) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

    $insert->execute([
        $uID,
        $fname,
        $mname,
        $lname,
        $gender,
        $age,
        $bday,
        $status,
        $contact,
        $purok,
        $purok_id,
        $barangay,
        $city,
        $province,
        $spouse,
        $father,
        $mother,
        $occupation,
        $school_level,
        $tribe,
        $ip_scholar,
        $ip_youth,
        $ip_women,
        $pwd,
        $senior_C,
        $SC_pensioner
    ]);

    $msg = 'Data inserted';
    header("Location: record.php?total&msg=$msg");
}

// Update Record
if (isset($_POST['update-record'])) {
    $ID = $_POST['id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $bday = $_POST['birthday'];
    $status = $_POST['status'];
    $contact = $_POST['contact'];
    $purok = $_POST['purok'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $spouse = $_POST['spouse'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $occupation = $_POST['occupation'];
    $school_level = $_POST['school'];
    $tribe = $_POST['tribe'];
    $ip_scholar = isset($_POST['ip_scholar']) ? "IP Scholar" : "N/A";
    $ip_youth = isset($_POST['ip_youth']) ? "IP Youth" : "N/A";
    $ip_women = isset($_POST['ip_women']) ? "IP Women" : "N/A";
    $pwd = isset($_POST['pwd']) ? "PWD" : "N/A";
    $senior_C = isset($_POST['senior_C']) ? "Senior Citizen" : "N/A";
    $SC_pensioner = isset($_POST['SC_pensioner']) ? "Pensioner" : "N/A";

    // Check if the purok exists in the database
    $check = $conn->prepare('SELECT * FROM purok WHERE purok = ?');
    $check->execute([$purok]);
    $data = $check->fetch();

    if ($data) {
        $purok_id = $data['id'];
    } else {
        $purok_id = null;
    }

    $update = $conn->prepare("UPDATE ip_records SET fname = ?, mname = ?, lname = ?, gender = ?, age = ?, birthday = ?, status = ?, contact_no = ?, purok = ?, purok_id = ?, barangay = ?, city = ?, province = ?, spouse = ?, father = ?, mother = ?, occupation = ?, school_level = ?, tribe = ?, ip_scholar = ?, ip_youth = ?, ip_women = ?, pwd = ?, senior_citizen = ?, sc_pensioner = ? WHERE id = ?");
    $update->execute([
        $fname,
        $mname,
        $lname,
        $gender,
        $age,
        $bday,
        $status,
        $contact,
        $purok,
        $purok_id,
        $barangay,
        $city,
        $province,
        $spouse,
        $father,
        $mother,
        $occupation,
        $school_level,
        $tribe,
        $ip_scholar,
        $ip_youth,
        $ip_women,
        $pwd,
        $senior_C,
        $SC_pensioner,
        $ID
    ]);

    $msg = "Record Updated!";
    header("Location: record.php?total&msg=$msg");
}

//Delete Records
if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    // DELETE FROM table_name WHERE condition;
    $delete = $conn->prepare("DELETE FROM ip_records WHERE id = ?");
    $delete->execute([$id]);

    $del = "Record Deleted!";
    header("Location: record.php?total&del=$del");
}


//Create Purok
if (isset($_POST['add-purok'])) {
    $uID = $_POST['u-ID'];
    $purok = $_POST['purok'];
    $household = $_POST['household'];

    // Check if the purok already exists
    $check = $conn->prepare('SELECT COUNT(*) FROM purok WHERE purok = ?');
    $check->execute([$purok]);
    $exists = $check->fetchColumn();

    if ($exists > 0) {
        $alrt = 'Purok already exists';
        header("Location: purok.php?alrt=$alrt");
    } else {
        // Insert new purok
        $insert = $conn->prepare('INSERT INTO purok(user_id, purok, household) VALUES(?,?,?)');
        $insert->execute([
            $uID,
            $purok,
            $household
        ]);

        $msg = 'Data inserted';
        header("Location: purok.php?msg=$msg");
    }
}


//Purok Update
if (isset($_POST['edit-purok'])) {
    $ID = $_POST['id'];
    $purok = $_POST['purok'];
    $household = $_POST['household'];

    $update = $conn->prepare("UPDATE purok SET purok = ?, household = ? WHERE id = ?");
    $update->execute([
        $purok,
        $household,
        $ID
    ]);

    $msg = "Purok Updated!";
    header("Location: purok.php?msg=$msg");

}

//Purok Delete
if (isset($_GET['delete_purok'])) {
    $id = $_GET['id'];

    // DELETE FROM table_name WHERE condition;
    $delete = $conn->prepare("DELETE FROM purok WHERE id = ?");
    $delete->execute([$id]);

    $del = "Purok Deleted!";
    header("Location: purok.php?del=$del");
}


// Create Form/Certificate
if (isset($_POST['add-form'])) {
    $uID = $_POST['u-ID'];
    $name = $_POST['name'];
    $file = $_FILES['file'];
    $allowedExtensions = ['pdf', 'docx'];
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

    // Check file size (1MB = 1048576 bytes)
    if ($file['error'] == 0 && in_array($fileExtension, $allowedExtensions) && $file['size'] <= 1048576) {
        $fileContent = file_get_contents($file['tmp_name']);

        $check = $conn->prepare('SELECT COUNT(*) FROM forms WHERE file_name = ?');
        $check->execute([$name]);
        $exists = $check->fetchColumn();

        if ($exists > 0) {
            $alrt = 'File already exists';
            header("Location: forms.php?alrt=$alrt");
        } else {
            $insert = $conn->prepare('INSERT INTO forms (user_id, file_name, file) VALUES (:user_id, :file_name, :file)');
            $success = $insert->execute([
                ':user_id' => $uID,
                ':file_name' => $name,
                ':file' => $fileContent
            ]);

            if ($success) {
                $msg = 'File inserted';
                header("Location: forms.php?msg=$msg");
            } else {
                $alrt = 'Error inserting data';
                header("Location: forms.php?alrt=$alrt");
            }
        }
    } else {
        $alrt = 'Invalid file type, file size exceeds 1MB, or error uploading file';
        header("Location: forms.php?alrt=$alrt");
    }
}


// Form/Certificate Update
if (isset($_POST['edit-form'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $file = $_FILES['file'];
    $allowedExtensions = ['pdf', 'docx'];
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

    $updateQuery = "UPDATE forms SET file_name = ?";
    $params = [$name];

    if ($file['error'] == 0 && in_array($fileExtension, $allowedExtensions) && $file['size'] <= 1048576) {
        $fileContent = file_get_contents($file['tmp_name']);
        $updateQuery .= ", file = ?";
        $params[] = $fileContent;
    } elseif ($file['error'] != 4) { // 4 means no file was uploaded
        $alrt = 'Invalid file type, file size exceeds 1MB, or error uploading file';
        header("Location: forms.php?alrt=$alrt");
        exit;
    }

    $updateQuery .= " WHERE id = ?";
    $params[] = $id;

    $update = $conn->prepare($updateQuery);
    $update->execute($params);

    $msg = "File Updated!";
    header("Location: forms.php?msg=$msg");
}


// Form/Certificate Delete
if (isset($_GET['delete_form'])) {
    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM forms WHERE id = ?");
    $delete->execute([$id]);

    $del = "File Deleted!";
    header("Location: forms.php?del=$del");
}
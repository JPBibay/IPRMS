<?php 
if(isset($_SESSION['logged_in'])){
    header("Location: index.php");
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" class="rounded-circle" href="assets/images/logo.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }

    /*------custom scrollbar-----*/
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #d1e5ff;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(#dc0b1c, #ff22e6, #fff);
        border-radius: 10px;
    }

    body {
        background-color: #c9d6ff;
        background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    }

    .container {
        background: #fff;
        width: 500px;
        padding: 1.2rem;
        margin: 4% auto;
        border-radius: 10px;
        box-shadow: 0 20px 35px rgba(0, 0, 1, 0.9);
    }
    </style>
</head>

<body>
    <?php include 'includes/sweetmessage.php'; ?>
    <div class="container" id="signIn">
        <div class="row justify-content-center mt-3">
            <div class="col-12 text-center mb-4">
                <img src="assets/images/logo.png" class="rounded-circle" style="width: 150px; height: 150px;"
                    alt="Logo">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-15">
                <h1 class="form-title text-center">Sign In</h1>
                <form method="post" action="process.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="name@example.com" required>
                            <span class="input-group-text me-2"><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" required>
                            <span class="input-group-text me-2"><i class="fas fa-lock" aria-hidden="true"></i></span>
                        </div>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary btn-block my-3 w-100" name="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>
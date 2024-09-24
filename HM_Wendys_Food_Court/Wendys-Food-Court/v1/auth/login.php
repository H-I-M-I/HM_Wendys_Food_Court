<?php
    include '../auth/db.php';
    
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $accounts = mysqli_query($conn, "select * from customer where email = '$email'");
        
        if (mysqli_num_rows($accounts) == 0) {
            echo '<div id="message" class="alert alert-danger m-0">No account exists with this email address.</div>';
        } else {
            foreach ($accounts as $account) {
                if (md5($password) == $account['password']) {
                    session_start();
                    $_SESSION['email'] = $account['email'];
                    $_SESSION['customer_id'] = $account['customer_id'];
                    $_SESSION['login'] = true;

                    if (isset($_GET['location'])) {
                        $location = $_GET['location'];
                        header("Location: ../customer/".$location.".php");
                    } else {
                        header("Location: ../customer/home.php");
                    }
                } else {
                    echo '<div id="message" class="alert alert-danger m-0">Password doesn\'t match.</div>';
                }
            }
        }
    }
?>

<?php
    include '../layouts/header.php';
?>

<head>
    <style>
        #message {
            position: absolute;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center form-container">
        <form class="p-5 rounded bg-light form-striped" method="post" autocomplete="off">
            <div class="title mb-5 text-center">
                <i class="fas fa-user bg-info text-light p-4 fa-3x mb-2"></i>
                <h2 class="text-center fw-bold">Login</h2>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control ps-0" id="email" placeholder="&#xF0E0;&emsp;Type your email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control ps-0" id="password" placeholder="&#xF502;&emsp;Type your password" autocomplete="off" required>
            </div>
            <button name="login" type="submit" class="btn btn-gradient text-white w-100">Login</button>
            <div class="row">
                <div class="col">
                    <div class="text-center mt-2 other">
                        <a href="#">Forgotten password?</a>
                    </div>

                    <div class="text-center my-4 fw-bold text-secondary">OR</div>
                    
                    <div class="text-center other">
                        <a href="registration.php">Create New Account</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function hideMessage() {
            try {
                document.getElementById("message").style.display = "none";
            } catch (error) {
                console.log('No error occured');
            }
        };
        setTimeout(hideMessage, 8000);
    </script>
</body>

</html>
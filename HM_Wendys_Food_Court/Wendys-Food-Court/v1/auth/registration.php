<?php
    include '../auth/db.php';

    if (isset($_POST['sign-up'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $cpassword = $_POST['c-password'];
        $user = mysqli_query($conn, "select * from customer where email = '$email'");
        
        if (isset($_POST['agree'])) {
            if (mysqli_num_rows($user) == 1) {
                echo '<div id="message" class="alert alert-danger m-0">An account already exists with this email.</div>';
            } else {
                if ($password == $cpassword) {
                    $query = mysqli_query($conn, "insert into customer (first_name, last_name, email, gender, password) values ('$fname', '$lname', '$email', '$gender', md5('$password'))");
                    header("Location: login.php");
                } else {
                    echo '<div id="message" class="alert alert-danger m-0">Password doesn\'t match.</div>';
                }
            }
        } else {
            echo '<div id="message" class="alert alert-danger m-0">You must agree to the terms and conditions.</div>';
        }
    }
?>

<?php
    include '../layouts/header.php';
?>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center form-container">
        <form class="px-5 py-3 rounded bg-light form-striped" method="post" autocomplete="off">
            <div class="title mb-3 text-center">
                <h2 class="text-center fw-bold">Sign up</h2>
            </div>
            
            <div class="form-group">
                <label for="name">Name</label>
                <div class="d-flex">
                    <input type="text" name="fname" class="form-control ps-0" id="fname" placeholder="&#xF508;&emsp;First name" autocomplete="off" required>
                    <input type="text" name="lname" class="form-control ps-0 ms-2" id="lname" placeholder="&#xF4FC;&emsp;Last name" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control ps-0" id="email" placeholder="&#xF0E0;&emsp;Type your email" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" class="form-control ps-0" id="phone" placeholder="&#xF879;&emsp;Type your phone number" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="gender">
                    <i class="fas fa-venus-mars text-secondary"></i> Select Gender
                </label>
                
                <div class="d-flex justify-content-between">
                    <div>
                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male">Male</label>
                    </div>
                    
                    <div>
                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female">Female</label>
                    </div>

                    <div>
                        <input type="radio" id="other" name="gender" value="other">
                        <label for="other">Other</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control ps-0" id="password" placeholder="&#xF502;&emsp;Type your password" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" name="c-password" class="form-control ps-0" id="password" placeholder="&#xF084;&emsp;Confirm your password" autocomplete="off" required>
            </div>

            <div class="form-group">
                <input type="checkbox" name="agree" id="agree">
                <label for="agree" class="text-secondary">I agree to all <a href="../docs/terms-conditions.php" target=_blank>terms and conditions</a>.</label>
            </div>

            <button type="submit" name="sign-up" class="btn btn-gradient text-white w-100">Sign up</button>

            <div class="row">
                <div class="col">
                    <div class="text-center mt-3 other">
                        <p>Already have an account?</p>
                    </div>
                    
                    <div class="text-center other">
                        <a href="login.php">Login</a>
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
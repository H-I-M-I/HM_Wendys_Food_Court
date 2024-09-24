<?php
    $page = 'profile';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<?php
    include '../auth/db.php';
    $email = $_SESSION['email'];
    $customer_id = $_SESSION['customer_id'];

    foreach (mysqli_query($conn, "select * from customer where customer.email = '$email'") as $c) {
        $user = $c;
        $id = $user['customer_id'];
    }

    $phone = mysqli_query($conn, "select * from phone where owner_type = 'customer' and owner_id = $id");
    
    // $addressQuery = mysqli_query($conn, "select * from address where address.customer_id = '$customer_id'");

    // if (mysqli_num_rows($addressQuery) > 0) {
    //     $addressAvailable = true;

    //     foreach ($addressQuery as $a) {
    //         $address = $a;
    //     }
    // } else {
    //     $addressAvailable = false;
    // }
?>

<head>
    <style>
        .profile-container {
            height: 100vh;
            padding: 100px 0 20px 0;
            gap: 20px;
        }

        .left-profile-section {
            width: 25%;
            height: 100%;
            padding: 30px;
            background-color: #333;
        }

        .left-profile-section .title h3 {
            font-weight: bold;

            <?php
                $colors = array(
                    "male" => "#3a7ecc",
                    "female" => "#ff69b4",
                    "other" => "#d6dee6"
                );
            ?>

            color: <?php echo $colors[$user['gender']] ?>;
            font-variant: small-caps;
        }

        .right-profile-section {
            height: 100%;
            flex-grow: 1;
        }

        .span-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .basic-row {
            display: grid;
            grid-template-columns: 1fr 2fr;
        }

        .basic-col {
            display: grid;
            grid-template-columns: 1fr 2fr;
        }

        .edit-info {
            text-decoration: none;
            cursor: pointer;
        }

        .edit-info:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container profile-container d-flex">
        <div class="left-profile-section card shadow">
            <div class="profile-picture-container w-100">
                <div class="profile-picture">
                    <?php
                        if (!$user['image']) {
                            echo '<img src="../../static/images/Default/default-'.$user['gender'].'.png" alt="profile photo" class="img-fluid rounded">';
                        } else {
                            echo '<img src="data:image;base64,'.base64_encode($user['image']).'" alt="'.$user['first_name'].'" alt="profile photo" class="img-fluid rounded">';
                        }
                    ?>
                </div>
            </div>

            <div class="profile-link-container">
                <div class="title py-3">
                    <h3>
                        <?php
                            echo $user['first_name'].' '.$user['last_name'];
                        ?>
                    </h3>
                </div>

                <div class="tab-list">
                    <div class="list-group w-100">
                        <button onclick="loadSection(1)" id="link-1" class="fw-bold my-1 w-100 text-center text-white py-2 bg-danger rounded">Basic</button>
                        <button onclick="loadSection(2)" id="link-2" class="fw-bold my-1 w-100 text-center text-danger py-2">Security</button>
                        <button onclick="loadSection(3)" id="link-3" class="fw-bold my-1 w-100 text-center text-danger py-2">Payment</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-profile-section bg-info">
            <div class="profile-data-container p-5">
                <div class="profile-content content-1 d-block">
                    <div class="title d-flex">
                        <h3>Basic information</h3>
                        <div class="ms-auto fw-bold text-danger edit-info">
                            Edit information <i class="fas fa-pencil-alt"></i>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="d-flex flex-column justify-content-evenly">
                            <div class="span-row my-1">
                                <div class="basic-col">
                                    <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">First name</div>
                                    <div class="p-2 bg-white shadow rounded"><?php echo $user['first_name'];?></div>
                                </div>
                                
                                <div class="basic-col">
                                    <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">Last name</div>
                                    <div class="p-2 bg-white shadow rounded"><?php echo $user['last_name'];?></div>
                                </div>
                            </div>

                            <div class="span-row my-1">
                                <div class="basic-col">
                                    <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">Date of birth</div>
                                    <div class="p-2 bg-white shadow rounded"><?php echo $user['dob'];?></div>
                                </div>
                                
                                <div class="basic-col">
                                    <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">Gender</div>
                                    <div class="p-2 bg-white shadow rounded"><?php echo $user['gender'];?></div>
                                </div>
                            </div>

                            <div class="basic-row my-1">
                                <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">Email</div>
                                <div class="p-2 bg-white shadow rounded"><?php echo $user['email'];?></div>
                            </div>

                            <div class="basic-row my-1">
                                <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">Phone</div>
                                <div class="p-2 bg-white shadow rounded">
                                    <?php
                                        foreach ($phone as $phn) {
                                            echo $phn['phone_number'];
                                        }
                                    ?>
                                </div>
                            </div>

                            <!-- <div class="basic-row my-1">
                                <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">House/Street</div>
                                <div class="p-2 bg-white shadow rounded">
                                    <?php
                                        if ($addressAvailable) {
                                            echo $address['house_street'];
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="basic-row my-1">
                                <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">City</div>
                                <div class="p-2 bg-white shadow rounded">
                                    <?php
                                        if ($addressAvailable) {
                                            echo $address['city'];
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="basic-row my-1">
                                <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">State/Province/Region</div>
                                <div class="p-2 bg-white shadow rounded">
                                    <?php
                                        if ($addressAvailable) {
                                            echo $address['state'];
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="basic-row my-1">
                                <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">ZIP/Postal Code</div>
                                <div class="p-2 bg-white shadow rounded">
                                    <?php
                                        if ($addressAvailable) {
                                            echo $address['zip'];
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="basic-row my-1">
                                <div class="p-2 bg-primary text-center text-white fw-bold shadow rounded">Country</div>
                                <div class="p-2 bg-white shadow rounded">
                                    <?php
                                        if ($addressAvailable) {
                                            echo $address['country'];
                                        }
                                    ?>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                
                <div class="profile-content content-2 d-none">
                    <h3>Security</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row py-3">
                                <div class="col-md-4">Name</div>
                                <div class="col-md-8">Aldrin Saurov Sarker</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-content content-3 d-none">
                    <h3>Payment</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row py-3">
                                <div class="col-md-4">Name</div>
                                <div class="col-md-8">Aldrin Saurov Sarker</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php
        include '../layouts/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function loadSection(id) {
            for (let i=1; i<=3; i++) {
                const link = document.getElementById("link-"+i);
                const content = document.querySelector('.content-'+i);

                if (id == i) {
                    link.classList.add('text-white', 'bg-danger');
                    link.classList.remove('text-danger', 'bg-white');
                    content.classList.add('d-block');
                    content.classList.remove('d-none');
                } else {
                    link.classList.remove('text-white', 'bg-danger');
                    link.classList.add('text-danger', 'bg-white');
                    content.classList.remove('d-block');
                    content.classList.add('d-none');
                }
            }
        }
    </script>
</body>

</html>
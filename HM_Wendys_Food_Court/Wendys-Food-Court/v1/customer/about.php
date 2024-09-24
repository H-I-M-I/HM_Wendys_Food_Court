<?php
    include '../auth/db.php';

    $employeeList = mysqli_query($conn, "select * from employee natural join shop order by shop_name, roles");
?>

<?php
    $page = 'about';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<head>
    <style>
        h1, h2, h4 {
            color: rebeccapurple;
        }

        p {
            text-align: justify;
            text-justify: inter-word;
        }

        .carousel,
        .carousel-inner,
        .carousel-item,
        .carousel-item img {
            height: 100%;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 30px;
        }

        @media screen and (max-width: 991px) {
            .grid-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media screen and (max-width: 767px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

        .grid-item {
            padding: 20px;
            height: auto;
        }

        .grid-item h5 {
            font-variant: small-caps;
            color: red;
        }
    </style>
</head>

<body class="bg-custom-2">
    <div class="container my-5 bg-light p-5">
        <header>
            <h1 class="fw-bold text-start py-5">About Us</h1>
        </header>

        <section id="about" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <div class="text-center">
                            <i class="fas fa-home display-3 text-primary"></i>
                        </div>
                        <h3 class="text-center mt-3 mb-2">Warm and Inviting Atmosphere</h3>
                        <p class="text-center lead">Our restaurant provides a cozy and welcoming atmosphere, where you can enjoy delicious food and great company.</p>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="text-center">
                            <i class="fas fa-user-friends display-3 text-primary"></i>
                        </div>
                        <h3 class="text-center mt-3 mb-2">Friendly and Professional Staff</h3>
                        <p class="text-center lead">Our staff is committed to providing excellent customer service, making sure that every guest feels welcome and satisfied.</p>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="text-center">
                            <i class="fas fa-calendar-alt display-3 text-primary"></i>
                        </div>
                        <h3 class="text-center mt-3 mb-2">Fresh and Seasonal Ingredients</h3>
                        <p class="text-center lead">We use only the freshest and highest quality ingredients, carefully selected from local farmers and suppliers, to ensure that every dish is delicious and healthy.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="mission-vision" class="bg-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="mb-4">Our Mission</h2>
                                <p class="lead mb-5">Our mission is to provide an exceptional dining experience that
                                    leaves a lasting impression on our customers. We strive to create a warm and
                                    welcoming atmosphere where everyone feels at home. We are committed to using fresh
                                    and locally sourced ingredients to create delicious and healthy meals that satisfy
                                    every taste bud. We also believe in giving back to the community by supporting local
                                    charities and initiatives that make a positive impact on people's lives.</p>
                            </div>

                            <div class="col-md-12">
                                <h2 class="mb-4">Our Vision</h2>
                                <p class="lead">Our vision is to become the go-to destination for foodies who appreciate
                                    quality cuisine and outstanding service. We aim to create a brand that is synonymous
                                    with excellence and innovation in the food industry. We envision a future where our
                                    restaurants are known for their unique ambiance, exceptional dishes, and attentive
                                    staff. We want to inspire people to try new flavors and expand their culinary
                                    horizons. We are committed to continuously improving and evolving our offerings to
                                    exceed our customers' expectations.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div id="image-carousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                    for ($i=1; $i <= 4; $i++) { 
                                        echo '
                                            <div class="carousel-item">
                                                <img src="../../static/images/carousel/carousel-'.$i.'.jpg" class="d-block w-100" alt="Restaurant Image '.$i.'">
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="employee">
            <h2 class="py-3">Our Team</h2>
            <div class="grid-container">
                <?php
                    foreach ($employeeList as $employee) {
                        echo
                        '
                            <div class="grid-item card bg-info">
                                <h4 class="text-uppercase fw-bold">'.$employee['first_name'].' '.$employee['last_name'].'</h4>
                                <h5>'.$employee['shop_name'].'</h5>
                                <p>'.$employee['roles'].'</p>
                                <p class="text-muted">'.$employee['email'].'</p>
                            </div>
                        ';
                    }
                ?>
            </div>
        </section>

        <section id="contact" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h2>Write to Us</h2>
                        <form action="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" placeholder="Enter subject"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="6" placeholder="Enter your message"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image">
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Attach file</label>
                                <input type="file" class="form-control" id="file">
                            </div>
                            <div type="submit" class="btn btn-primary w-100">Send</div>
                        </form>
                    </div>

                    <div class="col-md-6 mb-5">
                        <h2 class="mb-3">Contact Us</h2>
                        <ul class="list-unstyled">
                            <li class="my-2">
                                <i class="fas fa-map-marker-alt fa-2x me-2"></i>
                                <p>RG3R+C96, Khulna, Khulna Division, Bangladesh</p>
                            </li>
                            <li class="my-2">
                                <i class="fas fa-phone fa-2x me-2"></i>
                                <p>+880 1975-008435</p>
                            </li>
                            <li class="my-2">
                                <i class="fas fa-envelope fa-2x me-2"></i>
                                <p>wendysfoodcourt@gmail.com</p>
                            </li>
                        </ul>
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3691.251831175757!2d89.53870011432837!3d22.803548877112227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37558e2c8c097e17%3A0x7dbf6ec3e6d13f5e!2sYour%20Restaurant!5e0!3m2!1sen!2sus!4v1646217362192!5m2!1sen!2sus&amp;zoom=15"
                                    width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                                    aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php
        include '../layouts/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onload = () => {
            document.querySelector('.carousel-item').classList.add('active');
        };
    </script>
</body>

</html>
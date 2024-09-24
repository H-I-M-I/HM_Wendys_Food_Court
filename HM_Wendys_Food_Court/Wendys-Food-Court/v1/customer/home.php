<?php
    include '../auth/db.php';

    if ($result = mysqli_query($conn, "SHOW TABLES LIKE 'offer'")) {
        if(mysqli_num_rows($result) == 1) {
            $offerList = mysqli_query($conn,
                "select food_name, image, offer_price, price as regular_price, offer_description, end_time
                from offer inner join food
                on offer.food_id = food.food_id
                where end_time > now() OR end_time is null
                order by end_time desc");
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>Server Down</h1>";
            echo "Please wait patiently while we restore the server.";
            exit();
        }
    }
?>

<?php
    $page = 'home';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<head>
    <style>
        .btn-order {
            background-color: #663399;
        }

        .btn-order:hover {
            background-color: #7244a0;
        }
    </style>
</head>

<body>
    <section id="cover">
        <div class="container-fluid">
            <div class="image-container"></div>
            <div class="welcome">
                <h3 class="fw-bold fs-1">
                    <i class="fas fa-crown fs-5"></i> Welcome to
                </h3>
                <div class="name text-uppercase fw-bold display-2 text-center">Wendys Food Court</div>
                <h6 class="new-flavors text-uppercase">New flavors</h6>
                <div class="group-buttons mt-5">
                    <a href="menu.php" class="btn btn-warning fw-bold">Browse Menu</a>

                    <?php
                        if (isset($_SESSION['customer_id']) && $_SESSION['login']) {
                            echo '<a href="bookings.php" class="btn btn-warning fw-bold">Book/Host</a>';
                        } else {
                            echo '<a href="../auth/login.php?location=home" class="btn btn-warning fw-bold">Book/Host</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features section">
        <div class="container">
            <h1 class="text-uppercase fw-bold mt-5">Why choose us?</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="features-content">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="features-item first-feature wow fadeInUp f-1" data-wow-duration="1s"
                                    data-wow-delay="0s">
                                    <div class="first-number number">
                                        <h6>01</h6>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-mug-hot fa-4x"></i>
                                    </div>
                                    <h4>Exceptional Food Quality</h4>
                                    <div class="line-dec"></div>
                                    <p>Our foodcourt is known for its exceptional food quality, using only the freshest
                                        ingredients sourced from local producers. Our chefs are highly skilled and are
                                        constantly experimenting with new flavors and techniques to offer a unique
                                        culinary experience.</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="features-item second-feature wow fadeInUp f-2" data-wow-duration="1s"
                                    data-wow-delay="0.2s">
                                    <div class="second-number number">
                                        <h6>02</h6>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-concierge-bell fa-4x"></i>
                                    </div>
                                    <h4>Outstanding Service</h4>
                                    <div class="line-dec"></div>
                                    <p>The staff at our foodcourt are attentive, friendly and knowledgeable about the
                                        menu. They go above and beyond to ensure that every guest has a pleasant and
                                        memorable dining experience. Our foodcourt takes pride in providing exceptional
                                        service to its customers.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="features-item first-feature wow fadeInUp f-3" data-wow-duration="1s"
                                    data-wow-delay="0.4s">
                                    <div class="third-number number">
                                        <h6>03</h6>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-book-open fa-4x"></i>
                                    </div>
                                    <h4>Creative Menu</h4>
                                    <div class="line-dec"></div>
                                    <p>Our foodcourt's menu is constantly evolving, featuring innovative dishes that
                                        showcase the latest culinary trends. Our foodcourt prides itself on offering
                                        something for everyone, ensuring that all guests leave satisfied.</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="features-item second-feature last-features-item wow fadeInUp f-4"
                                    data-wow-duration="1s" data-wow-delay="0.6s">
                                    <div class="fourth-number number">
                                        <h6>04</h6>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-heart fa-4x"></i>
                                    </div>
                                    <h4>Welcoming Environment</h4>
                                    <div class="line-dec"></div>
                                    <p>The foodcourt creates a welcoming environment that makes guests feel comfortable
                                        and at ease. The staff are friendly and welcoming, and the foodcourt is
                                        inclusive and open to everyone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="delivery-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-center">
                    <h1>Get your food delivered right to your door</h1>
                    <div class="icon-grid">
                        <div class="icon-item shadow d-flex align-items-center justify-content-center flex-column p-5 rounded">
                            <i class="fas fa-utensils fa-3x"></i>
                            <p>Cooked by top chefs</p>
                        </div>
                        <div class="icon-item shadow d-flex align-items-center justify-content-center flex-column p-5 rounded">
                            <i class="fas fa-bicycle fa-3x"></i>
                            <p>Fastest delivery</p>
                        </div>
                        <div class="icon-item shadow d-flex align-items-center justify-content-center flex-column p-5 rounded">
                            <i class="fas fa-carrot fa-3x"></i>
                            <p>Healthy and fresh</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <img class="delivery-man-img" src="../../static/images/Layout/rider.png" alt="Delivery Man with Bike">
                </div>
            </div>
        </div>
    </section>

    <section id="offer">
        <div class="container my-5">
            <?php
                if (mysqli_num_rows($offerList) > 0) {
                    echo '
                        <h1 class="text-center fw-bold special">Today\'s <span>Special</span>
                            <i class="fas fa-fire"></i>
                        </h1>
                    ';
                }
            ?>

            <div class="row mt-2">
                <div class="owl-carousel">
                    <?php
                        foreach ($offerList as $offer) {
                            echo '
                                <div class="item mb-4 mx-2">
                                    <div class="card shadow">
                                        <img src="data:image;base64,'.base64_encode($offer['image']).'" alt="'.$offer['food_name'].'" class="card-img-top">
                                        <div class="card-body">
                                            <h4>'.$offer['food_name'].'</h4>
                                            <div class="price fw-bold">
                                                <del class="text-danger lead fw-bold">Regular price: ৳'.$offer['regular_price'].'</del>';
                                                
                                                if ($offer['offer_price'] != null) {
                                                    echo '<div class="text-success lead fw-bold">Offer price: ৳'.$offer['offer_price'].'</div>';
                                                }

                                                echo '
                                            </div>
                                            <div class="text-info">'.$offer['offer_description'].'</div>';

                                            if ($offer['end_time'] != null) {
                                                echo '<p class="text-secondary">Offer valid till: '.$offer['end_time'].'</p>';
                                            }
                                            echo '<a href="" class="btn text-light btn-order">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <hr class="bg-success">

    <section id="booking-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 booking-text mb-5">
                    <h2 class="fw-bold">Want to book a table in advance?</h2>
                    <p class="booking-description">Book now and enjoy the following benefits:</p>
                    <ol class="booking-benefits">
                        <li class="list-item">
                            <h3 class="headline">Guaranteed table availability</h3>
                            <p class="text-secondary">Ensure that you have a reserved spot for your meal, even during
                                busy times.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Faster service</h3>
                            <p class="text-secondary">With a pre-booked table, you'll receive faster service and can
                                enjoy your meal without unnecessary delays.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Prioritized seating</h3>
                            <p class="text-secondary">Get the best seats in the house with priority seating for
                                pre-booked tables.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Special promotions</h3>
                            <p class="text-secondary">Enjoy exclusive discounts and promotions that are only available
                                to those who book their tables in advance.</p>
                        </li>
                    </ol>
                    <div class="text-center w-100">
                        <button onclick="redirectToEvent('book')" class="btn btn-lg btn-primary booking-btn">🛎️ Book Now</button>
                    </div>
                </div>
                <div class="col-lg-6 booking-image mb-5">
                    <img src="../../static/images/Layout/book-now.png" alt="Table Bookings" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <hr class="bg-success">

    <section id="hosting-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5">
                    <div class="row">
                        <div class="col-md-12 p-2">
                            <img src="../../static/images/host/birthday.jpeg" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-12 p-2">
                            <img src="../../static/images/host/wedding.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-12 p-2">
                            <img src="../../static/images/Host/get-together.jpeg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 booking-text mb-5 text-end">
                    <h2 class="fw-bold pe-5">Host your events in our restaurant</h2>
                    <p class="booking-description pe-5">Host to enjoy the following benefits:</p>
                    <ol class="booking-benefits">
                        <li class="list-item">
                            <h3 class="headline">Free Venue Rental</h3>
                            <p class="text-secondary">We offer you a free rental of event space with a minimum food and
                                beverage purchase.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Complimentary Appetizers</h3>
                            <p class="text-secondary">We provide a complimentary appetizer platter for each table as a
                                welcome gesture for guests.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Discounted Packages</h3>
                            <p class="text-secondary">We offer discounted packages for events with a minimum guest
                                count, such as a set menu or a fixed-price package.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Customized Menus</h3>
                            <p class="text-secondary">We work with you to create a customized menu that meet your
                                specific dietary requirements and preferences.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Complimentary Decorations</h3>
                            <p class="text-secondary">We offer complimentary decorations, such as tablecloths,
                                centerpieces, and lighting, to create a festive atmosphere for the event.</p>
                        </li>
                        <li class="list-item">
                            <h3 class="headline">Free Parking</h3>
                            <p class="text-secondary">We provide free parking facilities only to our guests who host an
                                event in our foodcourt.</p>
                        </li>
                    </ol>
                    <div class="text-center w-100">
                        <button onclick="redirectToEvent('host')" class="btn btn-lg btn-primary booking-btn">🎉 Host Event</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        include '../layouts/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="../../static/js/owl-carousel.js"></script>
    <script>
        function redirectToEvent(eventType) {
            <?php
                if (isset($_SESSION['customer_id']) && $_SESSION['login']) {
                    echo 'window.location.href = "bookings.php?"+eventType+"=true"';
                } else {
                    echo 'window.location.href = "../auth/login.php?location=home"';
                }
            ?>
        }
    </script>

    <script>
        document.querySelector('.owl-nav').classList.remove('disabled');
    </script>
</body>

</html>
<?php
    $page = 'bookings';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<body>
    <div class="container mt-5 py-5">
        <div class="row">
            <div class="col-md-6 p-4 text-center d-grid">
                <div>
                    <h2>Book a table</h2>
                    <h4>Book a seat at our restaurant</h4>
                    <p>Fill out the form below to reserve your table.</p>
                    <?php
                        if (isset($_SESSION['customer_id']) && $_SESSION['login']) {
                            echo '<button type="button" id="book" class="btn btn-primary" data-toggle="modal" data-target="#bookModal">Book Now</button>';
                        } else {
                            echo '<a href="../auth/login.php?location=bookings" class="btn btn-primary">Book Now</a>';
                        }
                    ?>
                </div>

                <div class="p-4 pb-0">
                    <table class="table table-striped table-bordered book-table">
                        <thead>
                            <tr style="background-color:#333">
                                <th colspan="2" class="fw-bold text-light text-center fs-5 py-2 text-uppercase">services</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-custom-4 text-white text-center fs-5 py-2">
                                <td>1</td>
                                <td>Guaranteed table availability</td>
                            </tr>
                            <tr class="bg-custom-5 text-white text-center fs-5 py-2">
                                <td>2</td>
                                <td>Faster service</td>
                            </tr>
                            <tr class="bg-custom-6 text-white text-center fs-5 py-2">
                                <td>3</td>
                                <td>Prioritized seating</td>
                            </tr>
                            <tr class="bg-custom-4 text-white text-center fs-5 py-2">
                                <td>4</td>
                                <td>Special promotions</td>
                            </tr>
                            <tr class="bg-custom-5 text-white text-center fs-5 py-2">
                                <td>5</td>
                                <td>Better Customer Experience</td>
                            </tr>
                            <tr class="bg-custom-6 text-white text-center fs-5 py-2">
                                <td>6</td>
                                <td>Better Environment</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6 p-4 text-center d-grid">
                <div>
                    <h2>Host an event</h2>
                    <h4>We give you space to host your event</h4>
                    <p>Fill out the form below to host your event at our restaurant.</p>
                    <?php
                        if (isset($_SESSION['customer_id']) && $_SESSION['login']) {
                            echo '<button type="button" id="host" class="btn btn-primary" data-toggle="modal" data-target="#hostModal">Host Now</button>';
                        } else {
                            echo '<a href="../auth/login.php?location=bookings" class="btn btn-primary">Host Now</a>';
                        }
                    ?>
                </div>

                <div class="p-4 pb-0">
                    <table class="table table-striped table-bordered host-table">
                        <thead>
                            <tr style="background-color:#333">
                                <th colspan="2" class="fw-bold text-light text-center fs-5 py-2 text-uppercase">
                                    services</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-custom-1 text-white text-center fs-5 py-2">
                                <td>1</td>
                                <td>Free Venue Rental</td>
                            </tr>
                            <tr class="bg-custom-2 text-white text-center fs-5 py-2">
                                <td>2</td>
                                <td>Complimentary Appetizers</td>
                            </tr>
                            <tr class="bg-custom-3 text-white text-center fs-5 py-2">
                                <td>3</td>
                                <td>Discounted Packages</td>
                            </tr>
                            <tr class="bg-custom-1 text-white text-center fs-5 py-2">
                                <td>4</td>
                                <td>Customized Menus</td>
                            </tr>
                            <tr class="bg-custom-2 text-white text-center fs-5 py-2">
                                <td>5</td>
                                <td>Complimentary Decorations</td>
                            </tr>
                            <tr class="bg-custom-3 text-white text-center fs-5 py-2">
                                <td>6</td>
                                <td>Free Parking</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Book a Table</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-striped">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time">
                        </div>
                        <div class="form-group">
                            <label for="guests">Number of Guests</label>
                            <select class="form-control" id="guests">
                                <?php
                                    for ($i=1; $i<=20; $i++) {
                                        echo '<option>'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="special">Special Notes (Optional)</label>
                            <textarea class="form-control" id="special"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Book Now</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hostModal" tabindex="-1" role="dialog" aria-labelledby="hostModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hostModalLabel">Host an event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-striped">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group">
                            <label for="event-type">Event Type</label>
                            <select class="form-control" id="event-type">
                                <option>Birthday Party</option>
                                <option>Wedding</option>
                                <option>Corporate Event</option>
                                <option>Get together</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date">
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Host Now</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        include '../layouts/footer.php';
    ?>

    <script src="../../static/js/bg-changer.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.onload = function () {
            if (new URLSearchParams(window.location.search).get("host") === "true") {
                document.getElementById("host").click();
            } if (new URLSearchParams(window.location.search).get("book") === "true") {
                document.getElementById("book").click();
            }
        }
    </script>
</body>

</html>
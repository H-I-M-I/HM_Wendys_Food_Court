<?php
    include '../auth/db.php';
    $employeeList = mysqli_query($conn, "select * from employee natural join shop order by shop_name, roles");
    $customerList = mysqli_query($conn, "select * from customer");
?>

<?php
    $page = 'search';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<head>
    <link rel="stylesheet" href="query.css">
</head>

<body>
    <div class="alert alert-info pt-5 mt-5">Help Page</div>

    <div class="container">
        <details>
            <summary>Search for staff</summary>
            <form action="employee_query.php" method="post" class="py-5">
                <div class="form-group">
                    <label for="employee_id">Employee ID:</label>
                    <input type="number" class="form-control" id="employee_id" name="employee_id">
                </div>

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="roles">Roles:</label>
                    <select class="form-control" id="roles" name="roles">
                        <option value="">Select a role</option>
                        <option value="Manager">Manager</option>
                        <option value="Waiter">Waiter</option>
                        <option value="Chef">Chef</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="salary_from">Salary Range:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="salary_from" name="salary_from"
                                placeholder="From">
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="salary_to" name="salary_to" placeholder="To">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </details>

        <details>
            <summary>Search for bookings</summary>
            <form action="booking_query.php" method="GET" class="py-5">
                <div class="form-group">
                    <label for="booking_id">Booking ID:</label>
                    <input type="text" class="form-control" id="booking_id" name="booking_id">
                </div>

                <div class="form-group">
                    <label for="datetime">Date:</label>
                    <input type="date" class="form-control" id="time_stamp_book" name="time_stamp_book">
                </div>

                <div class="form-group">
                    <label for="booked_by">Booked By:</label>
                    <select class="form-control" id="booked_by" name="booked_by">
                        <option value="">No customer selected</option>
                        <?php 
                            while($row = mysqli_fetch_assoc($customerList)) {
                                echo "<option value='" . $row["first_name"] . " " . $row["last_name"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </details>

        <details>
            <summary>Search for events</summary>
            <form action="event_query.php" method="GET" class="py-5">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                        <select class="form-control" name="event_name">
                        <option value="">Select Event</option>
                        <option value="Birth Anniversary">Birth Anniversary</option>
                        <option value="Marrage Ceremony">Marrage Ceremony</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="event_duration">Event Duration:</label>
                    <select class="form-control" name="event_duration">
                        <option value="">Select Duration</option>
                        <?php
                            for ($i=1; $i <= 12; $i++) { 
                                echo '<option value="'.$i.'">'.$i.' hour(s)</option>';
                            }  
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="datetime">Date:</label>
                    <input type="date" class="form-control" id="time_stamp" name="time_stamp">
                </div>

                <div class="form-group">
                    <label for="hosted_by">Hosted By:</label>
                    <select class="form-control" id="hosted_by" name="hosted_by">
                        <option value="">No customer selected</option>
                        <?php 
                            while($row = mysqli_fetch_assoc($customerList)) {
                                echo "<option value='" . $row["first_name"] . " " . $row["last_name"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </details>

        <details>
            <summary>Search for stock entries</summary>
            <form action="stock_query.php" method="post" class="py-5">
                <div class="form-group">
                    <label for="entry_id">Entry ID:</label>
                    <input type="text" class="form-control" id="entry_id" name="entry_id">
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity">
                </div>

                <div class="form-group">
                    <label for="unit">Unit:</label>
                    <select class="form-control" id="unit" name="unit">
                        <option value="">No unit selected</option>
                        <option value="pcs">pcs</option>
                        <option value="Boxes">Boxes</option>
                        <option value="Cartons">Cartons</option>
                        <option value="Kgs">Kgs</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount_min">Minimum amount entry:</label>
                    <input type="number" class="form-control" id="amount_min" name="amount_min">
                </div>

                <div class="form-group">
                    <label for="amount_max">Maximum amount entry:</label>
                    <input type="number" class="form-control" id="amount_max" name="amount_max">
                </div>

                <div class="form-group">
                    <label for="datetime">Date:</label>
                    <input type="date" class="form-control" id="datetime" name="datetime">
                </div>

                <div class="form-group">
                    <label for="managed_by">Managed By:</label>
                    <select class="form-control" id="managed_by" name="managed_by">
                        <option value="">No employee selected</option>
                        <?php 
                            while($row = mysqli_fetch_assoc($employeeList)) {
                                echo "<option value='" . $row["first_name"] . " " . $row["last_name"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </details>
    </div>
</body>
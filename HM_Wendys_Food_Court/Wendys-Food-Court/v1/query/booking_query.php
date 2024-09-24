<?php
    $page = 'search';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<?php
    include '../auth/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $booking_id = $_GET['booking_id'];
        $time_stamp = $_GET["time_stamp_book"];
        $booked_by = $_GET["booked_by"];

        // Construct the SQL query to search for events
        $sql = "SELECT * FROM booking LEFT JOIN customer ON booking.booked_by = customer.customer_id WHERE 1=1";

        if (!empty($booking_id)) {
            $sql .= " AND booking_id = '$booking_id'";
        }

        if (!empty($time_stamp)) {
            $sql .= " AND DATE_FORMAT(time_stamp,'%Y-%m-%d') = '$time_stamp'";
        }

        if (!empty($booked_by)) {
            $sql .= " AND CONCAT_WS(' ', first_name, last_name) = '$booked_by'";
        }
        
        $result = mysqli_query($conn, $sql);

        echo '<div class="container py-5 my-5"><table class="table">';
        echo "<thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Date</th>
                    <th>Booked By</th>
                    <th>Booked Tables</td>
                </tr>
            </thead>";
        echo "<tbody>";

        foreach ($result as $row) {
            $id = $row["booking_id"];
            echo "<tr><td>" . $id . "</td><td>" . $row["time_stamp"] . "</td><td>" . $row["first_name"] . " ".$row["last_name"] . "</td>";
            
            $q = "  SELECT booked_tables.table_number
                    FROM booked_tables
                    WHERE booking_id = $id;";

            $tables = $conn->query($q);

            $table_numbers = "";
            if ($tables->num_rows > 0) {
                while ($table = $tables->fetch_assoc()) {
                    $table_numbers .= $table['table_number'] . ", ";
                }
                $table_numbers = rtrim($table_numbers, ", ");
            }
            echo '<td>'.$table_numbers.'<td></tr>';
        }        

        echo "</tbody></table></div>";
    }
?>

<?php
    $page = 'search';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<?php
    include '../auth/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $event_name = $_GET["event_name"];
        $event_duration = $_GET["event_duration"];
        $time_stamp = $_GET["time_stamp"];
        $hosted_by = $_GET["hosted_by"];

        // Construct the SQL query to search for events
        $sql = "SELECT * FROM events LEFT JOIN customer ON events.hosted_by = customer.customer_id WHERE 1=1";

        if (!empty($event_name)) {
            if ($event_name == "Other") {
                $sql .= " AND event_name NOT IN ('Birth Anniversary', 'Marrage Ceremony')";
            } else {
                $sql .= " AND event_name = '$event_name'";
            }
        }

        if (!empty($event_duration)) {
            $sql .= " AND event_duration = $event_duration";
        }

        if (!empty($time_stamp)) {
            $sql .= " AND DATE_FORMAT(time_stamp,'%Y-%m-%d') = '$time_stamp'";
        }

        if (!empty($hosted_by)) {
            $sql .= " AND CONCAT_WS(' ', first_name, last_name) = '$hosted_by'";
        }
        
        $result = mysqli_query($conn, $sql);

        echo '<div class="container py-5 my-5"><table class="table">';
        echo "<thead><tr><th>Event Name</th><th>Duration</th><th>Date</th><th>Hosted By</th></tr></thead>";
        echo "<tbody>";

        foreach ($result as $row) {
            echo "<tr><td>" . $row["event_name"] . "</td><td>" . $row["event_duration"] . " hours</td><td>" . $row["time_stamp"] . "</td><td>" .$row["first_name"] . " ".$row["last_name"]. "</td></tr>";
        }

        echo "</tbody></table></div>";
    }
?>

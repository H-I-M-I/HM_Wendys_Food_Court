<?php
    $page = 'search';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<?php
    include '../auth/db.php';

    $entryId = $_POST['entry_id'];
    $quantity = $_POST["quantity"];
    $unit = $_POST["unit"];
    $amountMin = $_POST["amount_min"];
    $amountMax = $_POST["amount_max"];
    $datetime = $_POST["datetime"];
    $managedBy = $_POST["managed_by"];
    
    $sql = "SELECT * FROM stock_entry LEFT JOIN employee ON stock_entry.managed_by = employee.employee_id WHERE 1=1";

    if (!empty($entryId)) {
      $sql .= " AND entry_id = '$entryId'";
    }

    if (!empty($quantity)) {
      $sql .= " AND quantity = '$quantity'";
    }

    if (!empty($unit)) {
      $sql .= " AND unit = '$unit'";
    }

    if (!empty($amountMin)) {
      $sql .= " AND amount >= '$amountMin'";
    }

    if (!empty($amountMax)) {
      $sql .= " AND amount <= '$amountMax'";
    }

    if (!empty($datetime)) {
      $sql .= " AND DATE_FORMAT(datetime,'%Y-%m-%d') = '$datetime'";
    }

    if (!empty($managedBy)) {
      $sql .= " AND CONCAT_WS(' ', first_name, last_name) = '$managedBy'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo '<div class="container mt-5 pt-5"><div class="table-responsive"><table class="table table-striped">';
      echo "<thead><tr><th>Entry ID</th><th>Quantity</th><th>Unit</th><th>Amount</th><th>Date/Time</th><th>Managed By</th></tr></thead><tbody>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["entry_id"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["unit"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["datetime"] . "</td><td>" . $row["first_name"] . " ".$row["last_name"]."</td></tr>";
      }
      echo "</tbody></table></div></div>";
    } else {
      echo '<div class="container mt-5 pt-5"><p>No results found in '.$datetime.'</p></div>';
    }    
?>

<?php
    $page = 'menu';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<?php
    include '../auth/db.php';
    
    $employee_id = $_POST['employee_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $roles = $_POST['roles'];
    $salary_from = $_POST['salary_from'];
    $salary_to = $_POST['salary_to'];

    // Construct SQL query based on user input
    $sql = "SELECT * FROM employee WHERE 1=1";

    if (!empty($employee_id)) {
    $sql .= " AND employee_id = $employee_id";
    }

    if (!empty($first_name)) {
    $sql .= " AND first_name LIKE '%$first_name%'";
    }

    if (!empty($last_name)) {
    $sql .= " AND last_name LIKE '%$last_name%'";
    }

    if (!empty($email)) {
    $sql .= " AND email LIKE '%$email%'";
    }

    if (!empty($roles)) {
    $sql .= " AND roles = '$roles'";
    }

    if (!empty($salary_from) || !empty($salary_to)) {
        if (!empty($salary_from) && !empty($salary_to)) {
          $sql .= " AND salary BETWEEN $salary_from AND $salary_to";
        } else if (!empty($salary_from)) {
          $sql .= " AND salary >= $salary_from";
        } else {
          $sql .= " AND salary <= $salary_to";
        }
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container pt-5 mt-5">';
        echo '<table class="table">';
        echo '<thead class="thead-dark"><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Roles</th><th>Salary</th><th>Shop ID</th></tr></thead>';
        echo '<tbody>';

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["employee_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["roles"] . "</td><td>" . $row["salary"] . "</td><td>" . $row["shop_id"] . "</td></tr>";
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo "No results found.";
    }
?>

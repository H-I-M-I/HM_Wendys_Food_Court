<?
    session_start();
?>

<?php
    $page = 'orders';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<?php
    if(empty($_SESSION['email']) || $_SESSION['email'] == '') {
        header('Location: ../auth/login.php');
        return;
    }
?>

<?php
    include '../auth/db.php';

    $customer_id = $_SESSION['customer_id'];

    $orderList = mysqli_query($conn,
        "select *
        from address, delivery natural join orders left join employee
        on orders.employee_id = employee.employee_id
        where address.address_id = delivery.address_id and order_id
        in (
            select order_id
            from orders
            where orders.customer_id = $customer_id)");

    $foodList = mysqli_query($conn,
        "select *
        from food_order natural join food
        where order_id in (
            select order_id
            from orders
            where orders.customer_id = $customer_id)");
?>

<head>
    <style>
        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    </style>
</head>

<body>
    <div class="container py-5 my-5">
        <div class="row">
            <?php
                foreach ($orderList as $order) {
                    echo
                    '
                        <div class="order-info">
                            <h4 class="text-info pt-5">Order</h4>    
                            <table class="table shadow"> 
                                <tr>
                                    <td class="fw-bold text-primary">Order Id</td>
                                    <td>'.$order['order_id'].'</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold text-primary">Bill</td>
                                    <td>'.$order['bill'].'</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold text-primary">Order Method</td>
                                    <td>'.$order['order_method'].'</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold text-primary">Description</td>
                                    <td>'.$order['description'].'</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold text-primary">Served by</td>
                                    <td>'.$order['first_name'].' '.$order['last_name'].'</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold text-primary">Time</td>
                                    <td>'.$order['time_stamp'].'</td>
                                </tr>

                                <tr>
                                    <td class="fw-bold text-primary" colspan="2">Items</td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <div class="row d-flex text-success">
                                            <div class="col border">Food name</div>
                                            <div class="col border">Quantity</div>
                                            <div class="col border">Base price</div>
                                            <div class="col border">Total price</div>
                                        </div>';

                                        foreach ($foodList as $food) {
                                            if ($food['order_id'] == $order['order_id']) {
                                                $grand_price = $food['price'] * $food['quantity'];
                                                echo '
                                                <div class="row d-flex">
                                                    <div class="col border">'.$food['food_name'].'</div>
                                                    <div class="col border">'.$food['quantity'].'</div>
                                                    <div class="col border">'.$food['price'].'</div>
                                                    <div class="col border">'.$grand_price.'.00</div>
                                                </div>';
                                            }
                                        }
                                        echo '
                                    </td>
                                </tr>

                                <tr>
                                    <td class="fw-bold text-primary" colspan="2">Address</td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <span>'.$order['house_no'].'</span>,
                                        <span>'.$order['street'].'</span>,
                                        <span>'.$order['zip_code'].'</span>,
                                        <span>'.$order['city'].'</span>,
                                        <span>'.$order['state'].'</span>,
                                        <span>'.$order['country'].'</span>.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
</body>
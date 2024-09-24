<?php
    include '../auth/db.php';

    if (isset($_GET['lower-price']) && isset($_GET['upper-price']) && isset($_GET['sort-by']) && isset($_GET['search'])) {
        $sort = $_GET['sort-by'];
        $lowerprice = $_GET['lower-price'];
        $upperprice = $_GET['upper-price'];
        $query = $_GET['search'];
        $search = true;

        if ($query == null) {
            $query = "";
        }
        
        if ($lowerprice == null && $upperprice == null) {
            $foodList = mysqli_query($conn,
                "select food.*, offer_price
                from food
                left join offer on food.food_id = offer.food_id
                where (food.food_name like '%".$query."%' or food.category like '%".$query."%')
                order by food.".$sort.", food.food_name");
        } else if ($lowerprice == null) {
            $foodList = mysqli_query($conn,
                "select food.*, offer_price
                from food
                left join offer on food.food_id = offer.food_id
                where 
                    (case
                    when offer.offer_price is null then food.price
                    else offer.offer_price
                    end)
                <= '$upperprice' and (food.food_name like '%".$query."%' or food.category like '%".$query."%')
                order by food.".$sort.", food.food_name");
        } else if ($upperprice == null) {
            $upperprice = $lowerprice;
            $foodList = mysqli_query($conn,
                "select food.*, offer_price
                from food
                left join offer on food.food_id = offer.food_id
                where
                    (case
                    when offer.offer_price is null then food.price
                    else offer.offer_price
                    end)
                >= '$lowerprice' and (food.food_name like '%".$query."%' or food.category like '%".$query."%')
                order by food.".$sort.", food.food_name");
        } else {
            $foodList = mysqli_query($conn,
                "select food.*, offer_price
                from food
                left join offer on food.food_id = offer.food_id
                where 
                    (case
                    when offer.offer_price is null then food.price
                    else offer.offer_price
                    end)
                between '$lowerprice' and '$upperprice' and (food.food_name like '%".$query."%' or food.category like '%".$query."%')
                order by food.".$sort.", food.food_name");
        }
    } else {
        $search = false;
        $lowerprice = 0;
        $upperprice = 0;
        $foodList = mysqli_query($conn,
            "select food.*, offer_price
            from food
            left join offer on food.food_id = offer.food_id
            order by food.food_name");
    }
    
    $restList = mysqli_query($conn, "select * from shop order by shop.shop_id");
    
?>

<?php
    $page = 'menu';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

<body class="bg-custom-2">
    <div class="container my-5 bg-light p-5">
        <div class="row mb-3">
            <div class="col">
                <h1 class="fw-bold">Wendys Menu</h1>
            </div>
        </div>

        <div class="filter">
            <form action="" method="get" class="d-grid">
                <div class="filter-row name-filter">
                    <h6>Search by food name or category</h6>
                    <input type="text" placeholder="i.e., burger, fastfood, etc." name="search" class="form-control"
                        value="<?php if (isset($_GET['search'])) { echo $_GET['search']; }?>">
                    <h6 class="ms-auto">Sort by</h6>
                    <select class="form-select" aria-label="Default select example" name="sort-by">
                        <option value="food_name" <?php if (isset($_GET['search'])) { if ($_GET['sort-by'] =='food_name') {
                            echo 'selected' ; } } ?>
                            >Name</option>

                        <option value="price" <?php if (isset($_GET['search'])) { if ($_GET['sort-by']=='price' ) {
                            echo 'selected' ; } } ?>
                            >Price</option>

                        <option value="category" <?php if (isset($_GET['search'])) { if ($_GET['sort-by']=='category' )
                            { echo 'selected' ; } } ?>
                            >Category</option>
                    </select>
                </div>
                <div class="filter-row price-filter">
                    <h6>Filter by price</h6>
                    <input type="number" placeholder="lower range" name="lower-price" class="form-control" min="0"
                        value="<?php if (isset($_GET['lower-price'])) { echo $_GET['lower-price']; }?>">
                    <input type="number" placeholder="upper range" name="upper-price" class="form-control" min="0"
                        value="<?php if (isset($_GET['upper-price'])) { echo $_GET['upper-price']; }?>">
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
            </form>
        </div>

        <?php
            if ($search) {
                echo '
                    <div class="row mt-5">
                        <div class="alert alert-info">
                            <h1>Showing '.mysqli_num_rows($foodList).' Result(s)</h1>
                        </div>
                    </div>
                ';
            }
        ?>
        

        <div class="row mb-3">
            <div class="col">
                <ul class="nav nav-tabs">
                    <?php
                        foreach ($restList as $rest) {
                            echo '
                                <li class="nav-item shop-tab">
                                    <a class="nav-link" data-bs-toggle="tab" href="#restaurant'.$rest['shop_id'].'">'.$rest['shop_name'].'</a>
                                </li>
                            ';
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div class="tab-content">
            <?php
                if (mysqli_num_rows($restList) > 0) {
                    foreach ($restList as $rest) {
                        if ($lowerprice > $upperprice) {
                            echo '
                                <div class="tab-pane fade" id="restaurant'.$rest['shop_id'].'">
                                    <div class="row">
                                        <h1 class="mt-5">Enter a valid price range.</h1>
                                    </div>
                                </div>';
                        } else {
                            if ($rest['is_open']) {
                                echo '<div class="tab-pane fade" id="restaurant'.$rest['shop_id'].'">';
                                        if (mysqli_num_rows($foodList) > 0) {
                                            $count = 0;
                                            foreach ($foodList as $food) {
                                                if ($food['shop_id'] == $rest['shop_id'] && $food['availability'] == 1) {
                                                    $count++;
                                                }
                                            }

                                            echo '<div class="alert alert-primary">'.$count.' Item';

                                            if ($count > 1) { echo 's'; }

                                            echo' in <i><b>'.$rest['shop_name'].'</b></i></div><div class="row menu">';
                                            
                                            if ($count > 0) {
                                                foreach ($foodList as $food) {
                                                    if ($food['shop_id'] == $rest['shop_id'] && $food['availability'] == 1) {
                                                        echo '
                                                        <div class="card menu-item">';
                                                            if (!$food['image']) {
                                                                echo '<img src="../../static/images/Default/default-food.jpg">';
                                                            } else {
                                                                echo '<img src="data:image;base64,'.base64_encode($food['image']).'" alt="'.$food['food_name'].'">';
                                                            }
                                                        
                                                            echo '<div class="d-flex w-100">
                                                                <span>'.$food['food_name'].'</span>';
                                                                    if ($food['offer_price'] == null) {
                                                                        echo '<span class="price ms-auto"><b>৳</b>'.$food['price'].'</span>';
                                                                    } else {
                                                                        echo '<span class="price ms-auto"><del><b>৳</b>'.$food['price'].'</del></span>';
                                                                        echo '<span class="price text-success"><b>&nbsp;৳</b>'.$food['offer_price'].'</span>';
                                                                    }
                                                                echo '
                                                            </div>
                                                            <div class="category text-secondary me-auto">'.$food['category'].'</div>
                                                            <div class="btn btn-primary mt-auto">
                                                                Add to Cart <i class="fas fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                    ';
                                                    } 
                                                }
                                            } else {
                                                echo '<h4 class="text-danger">Nothing to show.</h4>';
                                            }
                                        } else {
                                            echo '<h4 class="text-danger">Nothing to show.</h4>';
                                        }
                                        echo '</div>
                                    </div>
                                ';
                            } else {
                                echo '
                                    <div class="tab-pane fade mb-5" id="restaurant'.$rest['shop_id'].'">
                                        <h4>
                                            <i class="fas fa-exclamation-triangle text-danger"></i>
                                            SORRY! 
                                            <i class="text-bold text-info">'.$rest['shop_name'].'</i>
                                            is closed now!
                                            <i class="fas fa-frown text-warning"></i>
                                            But we\'ll open soon!
                                            <i class="fas fa-laugh-beam text-success"></i>
                                        </h4>
                                        <div class="closed"></div>
                                    </div>
                                ';
                            }
                        }
                    }
                }
            ?>
        </div>
    </div>

    <?php
        include '../layouts/footer.php';
    ?>

    <script src="../../static/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
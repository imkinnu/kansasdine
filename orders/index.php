<?php
include('./../include/session.php');
include('./../include/database.php');
?>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <title>Kansas Dine</title>
    <link rel="icon" href="<?php echo SECURE_PATH ?>assets/images/logo.png" type="image/gif" sizes="16x16">
</head>
<body>
<?php echo
cssFiles();
?>
<div class="container-fluid mb-4">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <?php renderHeader(); ?>
        </div>
        <div class="col-lg-8 col-md-9 col-sm-12 mt-4">
            <h4>My Orders</h4>
            <hr/>
            <?php
            //get the orderdetails based on session user id
            $getOrderDet = $database->connection->prepare("select * from orders where user_id=:user_id GROUP by invoice_no");
            $getOrderDet->execute(array('user_id' => $_SESSION['userid']));
            $sno = 1;
            if ($getOrderDet->rowCount() > 0) {
                while ($getOrderDetails = $getOrderDet->fetch(PDO::FETCH_ASSOC)) {
                    //get sum of amount based on cart id's
                    $getCar = $database->connection->prepare("select cartid from orders where invoice_no=:invoice_no");
                    $getCar->execute(array('invoice_no' => $getOrderDetails['invoice_no']));
                    $orderSum = 0;
                    while ($getCart = $getCar->fetch(PDO::FETCH_ASSOC)) {
                        $getSu = $database->connection->prepare("select price from cart where id=:id");
                        $getSu->execute(array('id' => $getCart['cartid']));
                        $getSum = $getSu->fetch(PDO::FETCH_ASSOC);
                        $orderSum += $getSum['price'];
                    }
                    ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <p class="text-small m-lg-0">Order Placed</p>
                                    <p class="text-medium fw-bolder m-lg-0"><?php echo date('d', $getOrderDetails['timestamp']) . " " . date('M', $getOrderDetails['timestamp']) . " " . date('Y', $getOrderDetails['timestamp']) ?></p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <p class="text-small m-lg-0">Total</p>
                                    <p class="text-medium fw-bolder m-lg-0"><?php echo "&#36; " . $orderSum ?></p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <p class="text-small m-lg-0">Invoice No</p>
                                    <p class="text-medium fw-bolder m-lg-0"><?php echo $getOrderDetails['invoice_no'] ?></p>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 d-flex align-items-center">
                                    <p class="text-large fw-bolder m-lg-0 text-success">Succesfull</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6>Item Details</h6>
                            <div class="row">
                                <?php
                                //get sum of amount based on cart id's
                                $getCar = $database->connection->prepare("select cartid from orders where invoice_no=:invoice_no");
                                $getCar->execute(array('invoice_no' => $getOrderDetails['invoice_no']));
                                $orderSum = 0;
                                while ($getCart = $getCar->fetch(PDO::FETCH_ASSOC)) {
                                    $getIte = $database->connection->prepare("select * from cart where id=:id");
                                    $getIte->execute(array('id' => $getCart['cartid']));
                                    $getItems = $getIte->fetch(PDO::FETCH_ASSOC);
                                    switch ($getItems['category']) {
                                        case 1 :
                                            echo "<div class='col-lg-3 col-md-3 col-sm-3'>";
                                            echo "<p class='m-lg-0'>Pizza</p>";
                                            echo "<p class='m-lg-0'>" . $database->get_name('pizza_types', 'id', $getItems['item_name'], 'type') . "</p>";
                                            echo "<p class='m-lg-0'>&#36;" . $getItems['price'] . "</p>";
                                            echo "</div>";
                                            break;
                                        case 2 :
                                            echo "<div class='col-lg-3 col-md-3 col-sm-3'>";
                                            echo "<p class='m-lg-0'>Beverages</p>";
                                            echo "<p class='m-lg-0'>" . $database->get_name('beverages', 'id', $getItems['item_name'], 'name') . "</p>";
                                            echo "<p class='m-lg-0'>&#36;" . $getItems['price'] . "</p>";
                                            echo "</div>";
                                            break;
                                        case 3 :
                                            echo "<div class='col-lg-3 col-md-3 col-sm-3'>";
                                            echo "<p class='m-lg-0'>Sandwitches</p>";
                                            echo "<p>" . $database->get_name('beverages', 'id', $getItems['item_name'], 'name') . "</p>";
                                            echo "<p class='m-lg-0'>&#36;" . $getItems['price'] . "</p>";
                                            echo "</div>";
                                            break;
                                        case 4 :
                                            echo "<div class='col-lg-3 col-md-3 col-sm-3'>";
                                            echo "<p class='m-lg-0'>Burgers</p>";
                                            echo "<p class='m-lg-0'>" . $database->get_name('burgers', 'id', $getItems['item_name'], 'name') . "</p>";
                                            echo "<p class='m-lg-0'> &#36;" . $getItems['price'] . "</p>";
                                            echo "</div>";
                                            break;
                                        default :
                                            echo "default";
                                            break;
                                    }
                                    ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                echo "No Orders Found";
            } ?>
        </div>
        <?php jsFiles();
        ?>
        <script>
            $('.header-orders').addClass('current_page_item');
        </script>
</body>
</html>
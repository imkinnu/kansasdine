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
            <h4>Cart</h4>
            <hr/>
            <div id="alert"></div>
            <?php
            $grandPrice = 0;
            //get the cart details based on session user id
            $getCartDet = $database->connection->prepare("select * from cart where user_id=:user_id and id not in (select cartid from orders)");
            $getCartDet->execute(array('user_id' => $_SESSION['userid']));
            $sno = 1;
            if ($getCartDet->rowCount() > 0) { ?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr class="bg-success text-white">
                        <th style="width: 10%">Sno</th>
                        <th style="width: 40%">Item Name</th>
                        <th style="width: 20%">Quantity</th>
                        <th class="text-center" style="width: 20%">Remove</th>
                        <th style="width: 20%">Price</th>
                    </tr>
                    </thead>
                    <?php
                    while ($getCartDetails = $getCartDet->fetch(PDO::FETCH_ASSOC)) {
                        $imgPath = $itemName = '';
                        if ($getCartDetails['category'] == 1) {
                            $imgPath = SECURE_PATH . 'assets/images/pizza/' . $database->get_name('pizza_types', 'id', $getCartDetails['item_name'], 'image');
                            $itemName = $database->get_name('pizza_types', 'id', $getCartDetails['item_name'], 'type');
                        } else if ($getCartDetails['category'] == 2) {
                            $imgPath = SECURE_PATH . 'assets/images/' . $database->get_name('pizza_types', 'id', $getCartDetails['item_name'], 'image');
                            $itemName = $database->get_name('beverages', 'id', $getCartDetails['item_name'], 'name');
                        } else if ($getCartDetails['category'] == 3) {
                            $imgPath = SECURE_PATH . 'assets/images/sandwiches/' . $database->get_name('pizza_types', 'id', $getCartDetails['item_name'], 'image');
                            $itemName = $database->get_name('sandwitches', 'id', $getCartDetails['item_name'], 'name');
                        } else if ($getCartDetails['category'] == 4) {
                            $imgPath = SECURE_PATH . 'assets/images/burgers/' . $database->get_name('pizza_types', 'id', $getCartDetails['item_name'], 'image');
                            $itemName = $database->get_name('burgers', 'id', $getCartDetails['item_name'], 'name');
                        }
                        $grandPrice += $getCartDetails['price'];
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo $sno++ ?></td>
                            <td><?php echo $itemName ?></td>
                            <td><?php echo $getCartDetails['quantity'] . " PC (S)" ?></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm"
                                        onclick="setState('alert','<?php echo SECURE_PATH ?>ajax/ajax.php','deleteItem=1&id=<?php echo $getCartDetails['id'] ?>')">
                                    <i class="fa fa-trash"></i></button>
                            </td>
                            <td class="text-primary fw-bold"><?php echo $getCartDetails['price'] . "&#36; " ?></td>
                        </tr>
                        </tbody>
                    <?php }
                    ?>
                    <tfoot>
                    <tr>
                        <td class="text-center fw-bold" colspan="4">Total Price</td>
                        <td class="fw-bolder text-info"><?php echo $grandPrice . "&#36; " ?></td>
                    </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-lg-8 col-md-4 col-sm-4">
                        <div id="smart-button-container">
                            <div style="text-align: center;">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 d-flex align-items-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Debit (or)
                            Credit Card
                        </button>
                    </div>
                </div>
                <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"
                        data-sdk-integration-source="button-factory"></script>
                <script>
                    function initPayPalButton() {
                        paypal.Buttons({
                            style: {
                                shape: 'rect',
                                color: 'gold',
                                layout: 'vertical',
                                label: 'paypal',

                            },

                            createOrder: function (data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        "amount": {
                                            "currency_code": "USD",
                                            "value":<?php echo $grandPrice ?>}
                                    }]
                                });
                            },

                            onApprove: function (data, actions) {
                                return actions.order.capture().then(function (details) {
                                    //create the order in orders table
                                    setState('alert', '<?php echo SECURE_PATH ?>ajax/ajax.php', 'orderItem=1&user_id=<?php echo $_SESSION['userid'] ?>&data=' + JSON.stringify(data));
                                    // alert('Transaction completed by ' + details.payer.name.given_name + '!');
                                    alert('Order Placed Succesfully !');
                                    location.reload();
                                });
                            },

                            onError: function (err) {
                                console.log(err);
                            }
                        }).render('#paypal-button-container');
                    }

                    initPayPalButton();
                </script>
            <?php } else {
                echo "No items in the cart";
            } ?>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pay by Credit or Debit Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 mt-lg-2">
                        <label for="">Name On Card</label>
                    </div>
                    <div class="col-lg-8 mt-lg-2">
                        <input type="text" class="form-control mandatory" name="Name On Card" id="name_card" value="" />
                    </div>
                    <div class="col-lg-4 mt-lg-2">
                        <label for="">Card No</label>
                    </div>
                    <div class="col-lg-8 mt-lg-2">
                        <input type="text" class="form-control mandatory" name="Card No" id="card_no" value="" />
                    </div>
                    <div class="col-lg-4 mt-lg-2">
                        <label for="">Card Expiry</label>
                    </div>
                    <div class="col-lg-4 mt-lg-2">
                        <select class="form-control mandatory" id="expiry_month" name="Month">
                            <option value="">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">Febraury</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-lg-2">
                        <select class="form-control mandatory" id="expiry_year" name="Year">
                            <option value="">Select Year</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-lg-2">
                        <label for="">CVV</label>
                    </div>
                    <div class="col-lg-4 mt-lg-2">
                        <input type="password" class="form-control mandatory" name="CVV" id="cvv" value="" />
                    </div>
                    <div class="col-lg-4 mt-lg-2">
                        <button class="btn btn-primary" onclick="makePayment()"><i class="fa fa-credit-card"></i> Make Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php jsFiles();
?>
<script>
    $('.header-cart').addClass('current_page_item');
    function makePayment()
    {
        if(ValidateFormFieldsNew() == 0)
        {
            setState('alert', '<?php echo SECURE_PATH ?>ajax/ajax.php', 'orderItem=1&user_id=<?php echo $_SESSION['userid'] ?>'+'&name='+$('#name_card').val()+'&card_no='+$('#card_no').val()+'&expiry_month='+$('#expiry_month').val()+'&expiry_year='+$('#expiry_year').val()+'&cvv='+$('#cvv').val()+'&type=card');
        }
    }
</script>
</body>
</html>
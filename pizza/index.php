<?php
include('./../include/session.php');
include('./../include/database.php');
?>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <title>Kansas Dine</title>
    <link rel="icon" href="<?php SECURE_PATH ?>assets/images/logo.png" type="image/gif" sizes="16x16">
</head>
<body>
<?php echo
cssFiles();

//get price ,crust dropdown values
$size = "<option value='1' selected>Regular</option>";
$crust = "<option value='1' selected>New Hand Tossed</option>";

$getSize = $database->connection->prepare("select * from size where id != 1");
$getSize->execute();
while ($getSizes = $getSize->fetch(PDO::FETCH_ASSOC)) {
    $size .= "<option value=" . $getSizes['id'] . ">" . $getSizes['size'] . "</option>";
}


$getCrus = $database->connection->prepare("select * from crust where id != 1");
$getCrus->execute();
while ($getCrust = $getCrus->fetch(PDO::FETCH_ASSOC)) {
    $crust .= "<option value=" . $getCrust['id'] . ">" . $getCrust['crust'] . "</option>";
}

?>
<div class="container-fluid mb-4">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <?php renderHeader(); ?>
        </div>
        <div class="col-lg-9 mt-3 mb-2">
            <div class="card mb-3 bg border-0"
                 style="position: -webkit-sticky;position: sticky;top: 0;font-size: 20px;z-index: 999;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10 col-sm-8 col-md-8 d-flex justify-content-end" id="cartSuccessMessage">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 d-flex align-items-center">
                            <a href="<?php echo SECURE_PATH ?>cart/" class="btn btn-info text-white">View Cart <i
                                        class="fa fa-cart-plus text-white"></i> <span id="cartCount"
                                                                                      class="badge badge-light"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <h3>Pizzas</h3>
                </div>
            </div>
            <div class="row mt-3" id="pizzas">
                <?php
                //get the pizza categories
                $getCategory = $database->connection->prepare("select id,category from categories");
                $getCategory->execute();
                $rowCounter = 0;
                $colors = ['bg-primary', 'bg-warning', 'bg-danger', 'bg-info'];
                while ($getCategories = $getCategory->fetch(PDO::FETCH_ASSOC)) { ?>
                    <h6 class="font-weight-bold text-success mt-5"><?php echo $getCategories['category'] ?></h6>
                    <hr/>
                    <?php //get the pizza details based on category

                    $bind_cat['category'] = $getCategories['id'];
                    $getPizzaDet = $database->connection->prepare("select * from pizza_prices where category=:category group by type");
                    $getPizzaDet->execute($bind_cat);
                    while ($getPizzaDetails = $getPizzaDet->fetch(PDO::FETCH_ASSOC)) {
                        $rowCounter++;
                        ?>
                        <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header <?php echo $colors[array_rand($colors)] ?> text-white">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 d-flex align-items-center">
                                            <h6 class="font-weight-bold text-medium text-white"><?php echo $database->get_name('pizza_types', 'id', $getPizzaDetails['type'], 'type') ?></h6>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 d-flex align-items-center">
                                            <h6 class="font-weight-bold text-large text-white"
                                                id="<?php echo $getPizzaDetails['id'] . '-price' ?>">
                                                &#36; 0 </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <img src="<?php echo SECURE_PATH.'assets/images/pizza/'.$database->get_name('pizza_types','id',$getPizzaDetails['type'],'image') ?>" alt="">
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <span class="text-small"><?php echo $database->get_name('pizza_types','id',$getPizzaDetails['type'],'description')?></span>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6.col-sm-6">
                                            <label class="text-small text-center m-lg-2 m-md-2 m-sm-2">Size</label>
                                            <select class="form-select form-select-sm"
                                                    id="<?php echo $getPizzaDetails['id'] . '-size' ?>"
                                                    onchange="setState('<?php echo $getPizzaDetails['id'] . '-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadPrice=1&category=<?php echo $getCategories['id'] ?>&type=<?php echo $getPizzaDetails['type'] ?>&size='+$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val()+'&crust='+$('#<?php echo $rowCounter . '-crust' ?>').val());$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val($('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val())">
                                                <?php echo $size ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-8 col-md-6.col-sm-6">
                                            <label class="text-small text-center m-lg-2 m-md-2 m-sm-2">Crust</label>
                                            <select class="form-select form-select-sm"
                                                    id="<?php echo $rowCounter . '-crust' ?>"
                                                    onchange="setState('<?php echo $getPizzaDetails['id'] . '-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadPrice=1&category=<?php echo $getCategories['id'] ?>&type=<?php echo $getPizzaDetails['type'] ?>&size='+$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val()+'&crust='+$('#<?php echo $rowCounter . '-crust' ?>').val());$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val($('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val())">
                                                <?php echo $crust ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="sauce"
                                                       id="<?php echo $rowCounter . '-sauce' ?>"
                                                       onclick="setState('<?php echo $getPizzaDetails['id'] . '-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadPrice=1&category=<?php echo $getCategories['id'] ?>&type=<?php echo $getPizzaDetails['type'] ?>&size='+$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val()+'&crust='+$('#<?php echo $rowCounter . '-crust' ?>').val()+'&quantity='+$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val()+'&sauce='+$('#<?php echo $rowCounter . '-sauce' ?>').is(':checked')+'&cheese='+$('#<?php echo $rowCounter . '-cheese' ?>').is(':checked'))">
                                                <label class="form-check-label" for="flexCheckDefault">Sauce</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="cheese"
                                                       id="<?php echo $rowCounter . '-cheese' ?>"
                                                       onclick="setState('<?php echo $getPizzaDetails['id'] . '-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadPrice=1&category=<?php echo $getCategories['id'] ?>&type=<?php echo $getPizzaDetails['type'] ?>&size='+$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val()+'&crust='+$('#<?php echo $rowCounter . '-crust' ?>').val()+'&quantity='+$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val()+'&sauce='+$('#<?php echo $rowCounter . '-sauce' ?>').is(':checked')+'&cheese='+$('#<?php echo $rowCounter . '-cheese' ?>').is(':checked'))">
                                                <label class="form-check-label" for="flexCheckChecked">Cheese</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="input-group">
                                                <button class="btn btn-outline-danger btn-sm" type="button"
                                                        onclick="changeCount('minus','<?php echo $getPizzaDetails['type'] . '-quantity' ?>',$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val(),'<?php echo $getPizzaDetails['type'] ?>','<?php echo $getCategories['id'] ?>',$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val(),$('#<?php echo $rowCounter . '-crust' ?>').val(),$('#<?php echo $rowCounter . '-sauce' ?>').is(':checked'),$('#<?php echo $rowCounter . '-cheese' ?>').is(':checked'));
                                                                setState('<?php echo $getPizzaDetails['id'] . '-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadPrice=1&category=<?php echo $getCategories['id'] ?>&type=<?php echo $getPizzaDetails['type'] ?>&size='+$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val()+'&crust='+$('#<?php echo $rowCounter . '-crust' ?>').val()+'&quantity='+$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val()+'&sauce='+$('#<?php echo $rowCounter . '-sauce' ?>').is(':checked')+'&cheese='+$('#<?php echo $rowCounter . '-cheese' ?>').is(':checked'));">
                                                    <i class="fa fa-minus"></i></button>
                                                <input type="text" class="form-control text-center"
                                                       aria-label="Text input with 2" value="0"
                                                       id="<?php echo $getPizzaDetails['type'] . '-quantity' ?>"
                                                       disabled/>
                                                <button class="btn btn-outline-success btn-sm" type="button"
                                                        onclick="changeCount('add','<?php echo $getPizzaDetails['type'] . '-quantity' ?>',$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val(),'<?php echo $getPizzaDetails['type'] ?>','<?php echo $getCategories['id'] ?>',$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val(),$('#<?php echo $rowCounter . '-crust' ?>').val(),$('#<?php echo $rowCounter . '-sauce' ?>').is(':checked'),$('#<?php echo $rowCounter . '-cheese' ?>').is(':checked'));
                                                                setState('<?php echo $getPizzaDetails['id'] . '-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadPrice=1&category=<?php echo $getCategories['id'] ?>&type=<?php echo $getPizzaDetails['type'] ?>&size='+$('#<?php echo $getPizzaDetails['id'] . '-size' ?>').val()+'&crust='+$('#<?php echo $rowCounter . '-crust' ?>').val()+'&quantity='+$('#<?php echo $getPizzaDetails['type'] . '-quantity' ?>').val()+'&sauce='+$('#<?php echo $rowCounter . '-sauce' ?>').is(':checked')+'&cheese='+$('#<?php echo $rowCounter . '-cheese' ?>').is(':checked'))">
                                                    <i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-9 mt-3 mb-2">
            <h3 class="">Beverages</h3>
            <div class="row" id="beverages">
                <?php
                //get the pizza categories
                $getBeverageDet = $database->connection->prepare("select * from beverages");
                $getBeverageDet->execute();
                $rowCounter = 0;
                $colors = ['bg-primary', 'bg-warning', 'bg-danger', 'bg-info'];
                while ($getBeverageDetails = $getBeverageDet->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header <?php echo $colors[array_rand($colors)] ?> text-white">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 d-flex align-items-center">
                                        <h6 class="font-weight-bold text-medium text-white"><?php echo $getBeverageDetails['name'] ?></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 d-flex align-items-center">
                                        <h6 class="font-weight-bold text-large text-white"
                                            id="<?php echo $getBeverageDetails['id'] . '-beverages-price' ?>">
                                            &#36; 0 </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img style="height: 100px;width:100px" src="<?php echo SECURE_PATH.'assets/images/'.$getBeverageDetails['image'] ?>" alt="">
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <span class="text-small">A classic delight with 100% Real mozzarella cheese</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger btn-sm" type="button"
                                                    onclick="changeBeveragesCount('minus','<?php echo $getBeverageDetails['id'] ?>','<?php echo $getBeverageDetails['id'] . '-beverages-quantity' ?>',$('#<?php echo $getBeverageDetails['id'] . '-beverages-quantity' ?>').val());
                                                            setState('<?php echo $getBeverageDetails['id'] . '-beverages-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadBeveragesPrice=1&id=<?php echo $getBeverageDetails['id'] ?>'+'&quantity='+$('#<?php echo $getBeverageDetails['id'] . '-beverages-quantity' ?>').val())">
                                                <i class="fa fa-minus"></i></button>
                                            <input type="text" class="form-control text-center"
                                                   aria-label="Text input with 2" value="0"
                                                   id="<?php echo $getBeverageDetails['id'] . '-beverages-quantity' ?>"
                                                   disabled />
                                            <button class="btn btn-outline-success btn-sm" type="button"
                                                    onclick="changeBeveragesCount('add','<?php echo $getBeverageDetails['id'] ?>','<?php echo $getBeverageDetails['id'] . '-beverages-quantity' ?>',$('#<?php echo $getBeverageDetails['id'] . '-beverages-quantity' ?>').val());
                                                            setState('<?php echo $getBeverageDetails['id'] . '-beverages-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadBeveragesPrice=1&id=<?php echo $getBeverageDetails['id'] ?>'+'&quantity='+$('#<?php echo $getBeverageDetails['id'] . '-beverages-quantity' ?>').val())">
                                                <i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-9 mt-3 mb-2">
            <h3 class="">Sandwiches</h3>
            <div class="row" id="sandwiches">
                <?php
                //get the pizza categories
                $getSandwichDet = $database->connection->prepare("select * from sandwitches");
                $getSandwichDet->execute();
                $rowCounter = 0;
                $colors = ['bg-primary', 'bg-warning', 'bg-danger', 'bg-info'];
                while ($getSandwichDetails = $getSandwichDet->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header <?php echo $colors[array_rand($colors)] ?> text-white">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 d-flex align-items-center">
                                        <h6 class="font-weight-bold text-medium text-white"><?php echo $getSandwichDetails['name'] ?></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 d-flex align-items-center">
                                        <h6 class="font-weight-bold text-large text-white"
                                            id="<?php echo $getSandwichDetails['id'] . '-sandwich-price' ?>">
                                            &#36; 0 </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img style="height: 100px;width:100px" src="<?php echo SECURE_PATH.'assets/images/sandwiches/'.$getSandwichDetails['image'] ?>" alt="">
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <span class="text-small">A classic delight with 100% Real mozzarella cheese</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger btn-sm" type="button"
                                                    onclick="changeSandwichesCount('minus','<?php echo $getSandwichDetails['id'] ?>','<?php echo $getSandwichDetails['id'] . '-sandwich-quantity' ?>',$('#<?php echo $getSandwichDetails['id'] . '-sandwich-quantity' ?>').val());
                                                            setState('<?php echo $getSandwichDetails['id'] . '-sandwich-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadSandwichPrice=1&id=<?php echo $getSandwichDetails['id'] ?>'+'&quantity='+$('#<?php echo $getSandwichDetails['id'] . '-sandwich-quantity' ?>').val())">
                                                <i class="fa fa-minus"></i></button>
                                            <input type="text" class="form-control text-center"
                                                   aria-label="Text input with 2" value="0"
                                                   id="<?php echo $getSandwichDetails['id'] . '-sandwich-quantity' ?>"
                                                   disabled />
                                            <button class="btn btn-outline-success btn-sm" type="button"
                                                    onclick="changeSandwichesCount('add','<?php echo $getSandwichDetails['id'] ?>','<?php echo $getSandwichDetails['id'] . '-sandwich-quantity' ?>',$('#<?php echo $getSandwichDetails['id'] . '-sandwich-quantity' ?>').val());
                                                            setState('<?php echo $getSandwichDetails['id'] . '-sandwich-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadSandwichPrice=1&id=<?php echo $getSandwichDetails['id'] ?>'+'&quantity='+$('#<?php echo $getSandwichDetails['id'] . '-sandwich-quantity' ?>').val())">
                                                <i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-9 mt-3 mb-2">
            <h3 class="">Burgers</h3>
            <div class="row" id="burgers">
                <?php
                //get the pizza categories
                $getBurgerDet = $database->connection->prepare("select * from burgers");
                $getBurgerDet->execute();
                $rowCounter = 0;
                $colors = ['bg-primary', 'bg-warning', 'bg-danger', 'bg-info'];
                while ($getBurgerDetails = $getBurgerDet->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header <?php echo $colors[array_rand($colors)] ?> text-white">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 d-flex align-items-center">
                                        <h6 class="font-weight-bold text-medium text-white"><?php echo $getBurgerDetails['name'] ?></h6>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 d-flex align-items-center">
                                        <h6 class="font-weight-bold text-large text-white"
                                            id="<?php echo $getBurgerDetails['id'] . '-burger-price' ?>">
                                            &#36; 0 </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img style="height: 100px;width:100px" src="<?php echo SECURE_PATH.'assets/images/burgers/'.$getBurgerDetails['image'] ?>" alt="">
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <span class="text-small">A classic delight with 100% Real mozzarella cheese</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="input-group">
                                            <button class="btn btn-outline-danger btn-sm" type="button"
                                                    onclick="changeBurgersCount('minus','<?php echo $getBurgerDetails['id'] ?>','<?php echo $getBurgerDetails['id'] . '-burger-quantity' ?>',$('#<?php echo $getBurgerDetails['id'] . '-burger-quantity' ?>').val());
                                                            setState('<?php echo $getBurgerDetails['id'] . '-burger-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadBurgerPrice=1&id=<?php echo $getBurgerDetails['id'] ?>'+'&quantity='+$('#<?php echo $getBurgerDetails['id'] . '-burger-quantity' ?>').val());">
                                                <i class="fa fa-minus"></i></button>
                                            <input type="text" class="form-control text-center"
                                                   aria-label="Text input with 2" value="0"
                                                   id="<?php echo $getBurgerDetails['id'] . '-burger-quantity' ?>"
                                                   disabled />
                                            <button class="btn btn-outline-success btn-sm" type="button"
                                                    onclick="changeBurgersCount('add','<?php echo $getBurgerDetails['id'] ?>','<?php echo $getBurgerDetails['id'] . '-burger-quantity' ?>',$('#<?php echo $getBurgerDetails['id'] . '-burger-quantity' ?>').val());
                                                            setState('<?php echo $getBurgerDetails['id'] . '-burger-price' ?>','<?php echo SECURE_PATH ?>ajax/ajax.php','loadBurgerPrice=1&id=<?php echo $getBurgerDetails['id'] ?>'+'&quantity='+$('#<?php echo $getBurgerDetails['id'] . '-burger-quantity' ?>').val())">
                                                <i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="paypal-button"></div>
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="cardModal_body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Pizza</th>
                            <th>Crust</th>
                            <th>Sauce</th>
                            <th>Cheese</th>
                        </tr>
                        </thead>
                        <tbody id="cart_body"></tbody>
                    </table>
                </div>
                <div class="modal-footer" id="proceed_button">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php jsFiles();
    ?>

    <script>
        $(".header-beverages").click(function () {
            $('html, body').animate({scrollTop: $("#beverages").offset().top}, 100);
        });
        $('.header-pizza').addClass('current_page_item');
    </script>
</body>
</html>
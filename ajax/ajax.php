<?php
include('./../include/session.php');
include('./../include/database.php');
//login
if (isset($_POST['login'])) {
    //remove special characters from input
    $_POST = $_GET = $_REQUEST = $database->cleanInput($_REQUEST);

    //server side validation for more security
    $validated = true;
    $reason = '';
    if (!isset($_POST['username']) || !isset($_POST['password']) || $_POST['username'] == '' || $_POST['password'] == '') {
        $validated = false;
        $reason = 'Invalid Parameters';
    }

    if ($validated) {

        $bind_array['username'] = $_POST['username'];
        $bind_array['password'] = md5($_POST['password']);

        //get the details of user based on username and password
        $getDat = $database->connection->prepare("select userid from users where username=:username and password=:password");
        $getDat->execute($bind_array);
        if ($getDat->rowCount() > 0) {
            $getData = $getDat->fetch(PDO::FETCH_ASSOC);
            $_SESSION['userid'] = $getData['userid'];
            echo "<span class='text-success fw-bold'>Login Successfull</span>";
            ?>
            <script>
                setTimeout(function () {
                    window.location.href = "<?php echo SECURE_PATH ?>"
                }, 300)
            </script>
        <?php } else {
            echo "<span class='text-danger'>Invalid username or password</span>";
        }
    } else {
        return;
    }
}
if (isset($_POST['loadPrice'])) {
    //make a validation here
    $validated = true;

    if (!isset($_POST['type']) || !isset($_POST['category']) || !isset($_POST['size']) || $_POST['type'] == '' || $_POST['category'] == '' || $_POST['size'] == '') {
        $validated = false;
        $reason = 'All Parameters not sent';
    }

    if ($validated && $_POST['size'] > 0) {
        $bind_array['category'] = $_POST['category'];
        $bind_array['type'] = $_POST['type'];
        $bind_array['size'] = $_POST['size'];
        $bind_array['crust'] = $_POST['crust'];
        $getPric = $database->connection->prepare("select price from pizza_prices where category=:category and type=:type and size=:size and crust=:crust");
        $getPric->execute($bind_array);
        $getPrice = $getPric->fetch(PDO::FETCH_ASSOC);

        $price = $getPrice['price'];

        if (isset($_POST['quantity'])) {
            $price = $_POST['quantity'] * $price;
        }

        if (isset($_POST['sauce']) && $_POST['sauce'] == 'true') {
            $price = (int)$price + 50;
        }
        if (isset($_POST['cheese']) && $_POST['cheese'] == 'true') {
            $price = (int)$price + 50;
        }
        echo "&#36; " . $price;
    } else {
        $database->throwCustomError($reason);
    }
}
if (isset($_POST['loadBeveragesPrice'])) {
    $validated = true;

    if (!isset($_POST['id']) || !isset($_POST['quantity']) || $_POST['id'] == '' || $_POST['quantity'] == '') {
        $validated = false;
        $reason = 'All Parameters not sent';
    }

    if ($validated) {
        $bind_array['id'] = $_POST['id'];
        $getPric = $database->connection->prepare("select price from beverages where id=:id");
        $getPric->execute($bind_array);
        $getPrice = $getPric->fetch(PDO::FETCH_ASSOC);

        $price = $getPrice['price'];

        if (isset($_POST['quantity'])) {
            $price = $_POST['quantity'] * $price;
        }

        echo "&#36; " . $price;
    }
}
if (isset($_POST['loadSandwichPrice'])) {
    $validated = true;

    if (!isset($_POST['id']) || !isset($_POST['quantity']) || $_POST['id'] == '' || $_POST['quantity'] == '') {
        $validated = false;
        $reason = 'All Parameters not sent';
    }

    if ($validated) {
        $bind_array['id'] = $_POST['id'];
        $getPric = $database->connection->prepare("select price from sandwitches where id=:id");
        $getPric->execute($bind_array);
        $getPrice = $getPric->fetch(PDO::FETCH_ASSOC);

        $price = $getPrice['price'];

        if (isset($_POST['quantity'])) {
            $price = $_POST['quantity'] * $price;
        }

        echo "&#36; " . $price;
    }
}
if (isset($_POST['loadBurgerPrice'])) {
    $validated = true;

    if (!isset($_POST['id']) || !isset($_POST['quantity']) || $_POST['id'] == '' || $_POST['quantity'] == '') {
        $validated = false;
        $reason = 'All Parameters not sent';
    }

    if ($validated) {
        $bind_array['id'] = $_POST['id'];
        $getPric = $database->connection->prepare("select price from burgers where id=:id");
        $getPric->execute($bind_array);
        $getPrice = $getPric->fetch(PDO::FETCH_ASSOC);

        $price = $getPrice['price'];

        if (isset($_POST['quantity'])) {
            $price = $_POST['quantity'] * $price;
        }

        echo "&#36; " . $price;
    }
}
if (isset($_POST['updateCart'])) {
    $validated = true;
    $reason = '';
    if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '' || !isset($_POST['category']) || !isset($_POST['itemname']) || $_POST['category'] == '' || $_POST['itemname'] == '') {
        $validated = false;
        $reason = 'Invaid Request';
    }
    if ($validated) {
        //declare an array for cart updation binding
        $cart_array['timestamp'] = time();
        $cart_array['user_id'] = $_SESSION['userid'];
        if ($_POST['category'] == 1) {
            $bind_array['type'] = $_POST['itemname'];
            $bind_array['size'] = $_POST['size'];
            $bind_array['crust'] = $_POST['crust'];

            //pizza
            //calculate the price
            $getPric = $database->connection->prepare("select price from pizza_prices where type=:type and size=:size and crust=:crust");
            $getPric->execute($bind_array);
            $getPrice = $getPric->fetch(PDO::FETCH_ASSOC);

            $price = $getPrice['price'];

            if (isset($_POST['quantity'])) {
                $price = $_POST['quantity'] * $price;
            }

            if (isset($_POST['sauce']) && $_POST['sauce'] == 'true') {
                $price = (int)$price + 50;
            }
            if (isset($_POST['cheese']) && $_POST['cheese'] == 'true') {
                $price = (int)$price + 50;
            }
            $cart_array['category'] = $_POST['category'];
            $cart_array['item_name'] = $_POST['itemname'];
            $cart_array['size'] = $_POST['size'];
            $cart_array['crust'] = $_POST['crust'];
            $cart_array['sauce'] = $_POST['sauce'] == true ? 1 : 0;
            $cart_array['cheese'] = $_POST['cheese'] == true ? 1 : 0;
            $cart_array['quantity'] = $_POST['quantity'];
            $cart_array['price'] = $price;
        } else {
            $tableName = '';
            if ($_POST['category'] == 2) {
                $tableName = 'beverages';
            } elseif ($_POST['category'] == 3) {
                $tableName = 'sandwitches';
            } else {
                $tableName = 'burgers';
            }

            $bind_array['id'] = $_POST['itemname'];

            //beverages
            //calculate the price
            $getPric = $database->connection->prepare("select price from beverages where id=:id");
            $getPric->execute($bind_array);
            $getPrice = $getPric->fetch(PDO::FETCH_ASSOC);

            $price = $getPrice['price'];

            $cart_array['category'] = $_POST['category'];
            $cart_array['item_name'] = $_POST['itemname'];
            $cart_array['size'] = '';
            $cart_array['crust'] = '';
            $cart_array['sauce'] = '';
            $cart_array['cheese'] = '';
            $cart_array['quantity'] = $_POST['quantity'];
            $cart_array['price'] = $price;
        }

        //update the cart
        //if the quantity is 0 delete that from cart
        if ($_POST['quantity'] == 0) {
            $delete_item = $database->connection->prepare("delete from cart where category=:category and item_name=:item_name");
            $delete_item->execute(array('category' => $_POST['category'], 'item_name' => $_POST['itemname']));
        } else {
            //check whether this item is aleady exists in the cart
            if ($_POST['category'] == 1) {
                $check = $database->connection->prepare("select quantity from cart where user_id=:user_id and category=:category and item_name=:item_name");
                $check->execute(array('user_id' => $_SESSION['userid'], 'category' => 1, 'item_name' => $_POST['itemname']));
                if ($check->rowCount() > 0) {
                    $getQuantity = $check->fetch(PDO::FETCH_ASSOC);
                    $_POST['quantity'] += $getQuantity['quantity'];
                    $cart_array['quantity'] = $_POST['quantity'];
                    $cart_array['price'] = $_POST['quantity'] * $price;
                }
            } else {
                $check = $database->connection->prepare("select quantity from cart where user_id=:user_id and category=:category and item_name=:item_name");
                $check->execute(array('user_id' => $_SESSION['userid'], 'category' => $_POST['category'], 'item_name' => $_POST['itemname']));
                if ($check->rowCount() > 0) {
                    $getQuantity = $check->fetch(PDO::FETCH_ASSOC);
                    $_POST['quantity'] += $getQuantity['quantity'];
                    $cart_array['quantity'] = $_POST['quantity'];
                    $cart_array['price'] = $_POST['quantity'] * $price;
                }
            }

            $updCart = $database->connection->prepare("insert into cart values (NULL,:user_id,:category,:item_name,:size,:crust,:sauce,:cheese,:quantity,:price,:timestamp ) ON DUPLICATE KEY UPDATE size=:size,crust=:crust,sauce=:sauce,cheese=:cheese,quantity=:quantity,price=:price,timestamp=:timestamp");
            echo "insert into cart values (NULL,:user_id,:category,:item_name,:size,:crust,:sauce,:cheese,:quantity,:price,:timestamp ) ON DUPLICATE KEY UPDATE size=:size,crust=:crust,sauce=:sauce,cheese=:cheese,quantity=:quantity,price=:price,timestamp=:timestamp";
            print_r($cart_array);
            $updCart->execute($cart_array);
        }
    }
}
if (isset($_POST['deleteItem'])) {
    ?>
    <script>
        if (confirm("Are you sure you want to remove this item from cart ?") == true) {
            setState('alert', '<?php echo SECURE_PATH ?>ajax/ajax.php', 'confirmDeleteItem=1&id=<?php echo $_POST['id'] ?>')
        }
    </script>
<?php }
if (isset($_POST['confirmDeleteItem'])) {
    $validated = true;
    if (!isset($_POST['id']) || $_POST['id'] == '') {
        $validated = false;
    }
    if ($validated) {
        $deleteItem = $database->connection->prepare("delete from cart where id=:id");
        $deleteItem->execute(array('id' => $_POST['id']));
        if ($deleteItem) {
            echo "Item Removed from cart successfully";
            echo "<script>location.reload()</script>";
        }
    }
}
if (isset($_POST['registerUser'])) { ?>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-center align-items-center bg-primary text-white">
            <span class="fw-bold">Register</span>
        </div>
        <div class="card-body">
            <form class="row g-3 needs-validation d-flex justify-content-center" novalidate>
                <div class="col-lg-4 d-flex justify-content-center">
                    <label for="username" class="form-label fw-bold">Username</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <input name="Username" type="text" class="form-control mandatory" id="username" value="" required
                           autocomplete="off"/>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <label for="username" class="form-label fw-bold">First Name</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <input name="First Name" type="text" class="form-control mandatory" id="firstname" value="" required
                           autocomplete="off"/>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <label for="password" class="form-label fw-bold">Last Name</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <input name="Last Name" type="text" class="form-control mandatory" id="lastname" value="" required
                           autocomplete="off"/>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <label for="email" class="form-label fw-bold">Email</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <input name="Email" type="text" class="form-control mandatory" id="email" value="" required
                           autocomplete="off"/>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <label for="mobile" class="form-label fw-bold">Mobile</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <input name="Mobile No" type="text" class="form-control mandatory" id="mobile" value="" required
                           autocomplete="off"/>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <label for="mobile" class="form-label fw-bold">Password</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <input name="Password" type="password" class="form-control mandatory" id="password" value=""
                           autocomplete="off"/>
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <label for="mobile" class="form-label fw-bold">Confirm Password</label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <input name="Confirm Password" type="password" class="form-control mandatory" id="cpassword"
                           value="" required autocomplete="off"/>
                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <button class="btn btn-outline-primary" type="button" onclick="registerUser()">Register</button>
                </div>
                <a class="btn btn-link" href="<?php echo SECURE_PATH ?>">Login</a>
                <div class="col-lg-12 d-flex justify-content-center" id="login_message">

                </div>
            </form>
            <script>
                function registerUser() {
                    if (ValidateFormFieldsNew() == 0) {
                        setState('login_message', '<?php echo SECURE_PATH ?>ajax/ajax.php', 'register=1&username=' + $('#username').val() + '&firstname=' + $('#firstname').val() + '&lastname=' + $('#lastname').val() + '&email=' + $('#email').val() + '&mobile=' + $('#mobile').val() + '&password=' + $('#password').val() + '&cpassword=' + $('#cpassword').val())
                    }
                }
            </script>
        </div>
    </div>
<?php }
if (isset($_POST['register'])) {
    $validated = true;
    if (!isset($_POST['username']) || $_POST['username'] == '' || !isset($_POST['firstname']) || $_POST['firstname'] == '' || !isset($_POST['lastname']) || $_POST['lastname'] == '' || !isset($_POST['email']) || $_POST['email'] == '' || !isset($_POST['mobile']) || $_POST['mobile'] == '' || !isset($_POST['password']) || $_POST['password'] == '' || !isset($_POST['cpassword']) || $_POST['cpassword'] == '') {
        $validated = false;
    }

    if($_POST['password'] != $_POST['cpassword'])
    {
        echo "<span class='text-danger'>Passwords don't match</span>";
        exit();
    }

    //check whether username already exists
    $id = $database->get_name('users','username',$_POST['username'],'id');
    if($id != '')
    {
        echo "<span class='text-danger'>Username already exists ! please try another username</span>";
        exit();
    }

    if($validated)
    {
        //create a user id
        $getCoun = $database->connection->prepare("select max(id) as max from users");
        $getCoun ->execute();
        $getCount = $getCoun->fetch(PDO::FETCH_ASSOC);

        $bind_array['username'] = $_POST['username'];
        $bind_array['firstname'] = $_POST['firstname'];
        $bind_array['lastname'] = $_POST['lastname'];
        $bind_array['mobile'] = $_POST['mobile'];
        $bind_array['email'] = $_POST['email'];
        $bind_array['password'] = md5($_POST['password']);
        $bind_array['timestamp'] = time();
        $bind_array['userid'] = "USR".sprintf('%04d',$getCount['max'] + 1);
        $bind_array['last_logged_in'] = '';

        $createUser = $database->connection->prepare("insert into users VALUES (NULL,:username,:firstname,:lastname,:mobile,:email,:password,:timestamp,:userid,:last_logged_in)");
        $createUser->execute($bind_array);
        if($createUser)
        {
            echo "<script>alert('User Successfully Created');location.reload()</script>";
        }
    }
    else {
        echo "<span class='text-danger'>Invalid Request</span>";
    }
}
if (isset($_POST['orderItem'])) {
    if (isset($_POST['type'])) {
        //payment type is debit or credit card
        $validated = true;
        if (!isset($_POST['user_id']) || $_POST['user_id'] == '' || !isset($_POST['name']) || $_POST['name'] == '' || !isset($_POST['card_no']) || $_POST['card_no'] == '' || !isset($_POST['expiry_month']) || $_POST['expiry_month'] == '' || !isset($_POST['expiry_year']) || $_POST['expiry_year'] == '' || !isset($_POST['cvv']) || $_POST['cvv'] == '') {
            $validated = false;
        }

        if ($validated) {
            //create an array with payment details and serialize it and store in the db
            $payment_info = array($_POST['name'], $_POST['card_no'], $_POST['expiry_month'], $_POST['expiry_year'], $_POST['cvv']);

            $getCartDet = $database->connection->prepare("select id from cart where user_id=:user_id and id not in (select cartid from orders)");
            $getCartDet->execute(array('user_id' => $_POST['user_id']));
            $invoice_no = "INVOICE-" . $_SESSION['userid'] . '-';
            $getMa = $database->connection->prepare("select max(id) as max from orders where user_id=:user_id");
            $getMa->execute(array('user_id' => $_POST['user_id']));
            $getMax = $getMa->fetch(PDO::FETCH_ASSOC);
            $invoice_no .= sprintf('%04d', $getMax['max'] + 1);
            while ($getCartDetails = $getCartDet->fetch(PDO::FETCH_ASSOC)) {
                $insOrders = $database->connection->prepare("insert into orders values (NULL,:user_id,:cartid,:payment_info,:invoice_no,:timestamp)");
                $insOrders->execute(array('user_id' => $_POST['user_id'], 'cartid' => $getCartDetails['id'], 'payment_info' => serialize($payment_info), 'invoice_no' => $invoice_no, 'timestamp' => time()));
            }
            if ($insOrders) {
                echo "<script>$('#staticBackdrop').modal('hide');alert('Order Placed Successfully');location.reload()</script>";
            }
        }
    } else {
        //payment type is paypal
        //get all the items and insert them into cart
        $getCartDet = $database->connection->prepare("select id from cart where user_id=:user_id and id not in (select cartid from orders)");
        $getCartDet->execute(array('user_id' => $_POST['user_id']));
        //generate invoice number
        $invoice_no = "INVOICE-" . $_SESSION['userid'] . '-';
        $getMa = $database->connection->prepare("select max(id) as max from orders where user_id=:user_id");
        $getMa->execute(array('user_id' => $_POST['user_id']));
        $getMax = $getMa->fetch(PDO::FETCH_ASSOC);
        $invoice_no .= sprintf('%04d', $getMax['max'] + 1);
        while ($getCartDetails = $getCartDet->fetch(PDO::FETCH_ASSOC)) {
            $insOrders = $database->connection->prepare("insert into orders values (NULL,:user_id,:cartid,:invoice_no,:timestamp)");
            $insOrders->execute(array('user_id' => $_POST['user_id'], 'cartid' => $getCartDetails['id'], 'invoice_no' => $invoice_no, 'timestamp' => time()));
        }
    }
}
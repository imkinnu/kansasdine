<?php
include('./include/session.php');
include('./include/database.php');
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
cssFiles(); ?>
<div class="container-fluid mb-4 h-100vh">
    <?php if (!isset($_SESSION['userid'])){
    ?>
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="card shadow-sm" id="loginForm">
                <div class="card-header d-flex justify-content-center align-items-center bg-primary text-white">
                    <span class="fw-bold">Login</span>
                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation d-flex justify-content-center" novalidate>
                        <div class="col-lg-4 d-flex justify-content-center">
                            <label for="username" class="form-label fw-bold">Username</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <input name="Username" type="text" class="form-control mandatory" id="username" value="" required autocomplete="off" aria-describedby="usernameerror">
                        </div>
                        <div class="col-lg-4 d-flex justify-content-center">
                            <label for="password" class="form-label fw-bold">Password</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <input name="Password" type="password" class="form-control mandatory" id="password" value="" required autocomplete="off" aria-describedby="passworderror" minlength="6">
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center">
                            <button class="btn btn-outline-primary" type="button" onclick="login()">Login</button>
                        </div>
                        <button type="button" class="btn btn-link" onclick="setState('loginForm','<?php echo SECURE_PATH ?>ajax/ajax.php','registerUser=1')">Register</button>
                        <div class="col-lg-12 d-flex justify-content-center" id="login_message">

                        </div>
                        <script>
                            function login()
                            {
                                if(ValidateFormFieldsNew() == 0)
                                {
                                    setState('login_message','<?php echo SECURE_PATH ?>ajax/ajax.php','login=1&username='+$('#username').val()+'&password='+$('#password').val())
                                }
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <?php renderHeader(); ?>
            </div>
            <div class="col-lg-8 mt-5 d-flex justify-content-center align-items-center">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo SECURE_PATH ?>assets/upload/slide4.jpg" class="d-block w-100"
                                 alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h3 class="text-warning">Our mission is to share our family’s authentic Pizza recipes with the world.</h3>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SECURE_PATH ?>assets/upload/bg-pizza.jpg" class="d-block w-100"
                                 alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h3 class="text-primary">Our mission is to WOW people every day!</h3>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo SECURE_PATH ?>assets/upload/slide5.jpg" class="d-block w-100"
                                 alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h3 class="text-info">Quality. Passion. Pride.</h3>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php jsFiles();
    ?>
    <script>
        function ValidateFormFieldsNew() {
            var err = 0;
            $('.err_msg').html('');
            $(".mandatory").filter(function () {
                var name = $(this).attr('name');
                if ($(this).prop("type") == "checkbox" || $(this).prop("type") == "radio" || $(this).prop("type") == "select-one" || $(this).prop("type") == "select") {
                    if ($(this).val() == '') {
                        err++;
                        $(this).after("<span class='err_msg text-danger'  style='margin-top:5px;font-size: 13px;'>Please Select " + name + "</span>");
                        return $(this).val().trim() == "" || !this.checked;
                    }
                } else {
                    var minLength = $(this).prop("minlength");
                    if (minLength > $(this).val().length) {
                        err++;
                        $(this).after("<span class='err_msg'  style='margin-top:5px;color: #f08f1c;font-size: 13px;'>You can't write less than " + minLength + " chacters</span>");
                    }
                    if ($(this).prop("type") == "text" || $(this).prop("type") == "textarea" || $(this).prop("type") == "password" || $(this).prop("type") == "date") {
                        if ($(this).val() == '') {
                            err++;
                            $(this).after("<span class='err_msg text-danger'  style='margin-top:5px;font-size: 13px;'>Please Enter " + name + "</span>");
                        }
                    } else if ($(this).prop("type") == "email") {
                        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                        if ($(this).val() == '') {
                            err++;
                            $(this).after("<span class='err_msg text-danger'  style='font-size: 13px;'>Please fill this field</span>");
                        } else if (!emailReg.test($(this).val())) {
                            err++;
                            $(this).after("<span class='err_msg text-danger'  style='margin-top:5px;margin-left: 5px;font-size: 13px;'>Please Enter Valid email</span>");
                        }
                    }
                    return $(this).prop('id');
                    // return this.value.trim() == "";
                }

            }).first().focus();
            if (err > 0) {
                return "1";

            } else {
                return "0";
            }
        }
        $('.menu-item-home').addClass('current_page_item');
    </script>
</body>
</html>
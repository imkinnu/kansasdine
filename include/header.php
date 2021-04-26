<?php
//constants section

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "restaurant");


define('SECURE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . '/restaurant/');

define('SUCCESS_MESSAGE', 'Data Submitted succesfully');
define('VEHICLE_ERROR', 'Please select atleast one vehicle');
define('LOAD_ERROR', 'Please enter load');
define('VERSION', '1.0 &alpha;');

function cssFiles()
{ ?>
    <link rel="stylesheet" href="<?php echo SECURE_PATH ?>cdn/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo SECURE_PATH ?>assets/css/style.css" type='text/css' media='all' >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel='stylesheet'
          href='http://fonts.googleapis.com/css?family=Merriweather%3A%2C400%7CPatua+One%3A400&amp;ver=1.0.0'
          type='text/css' media='all'/>
    <link href="http://fonts.googleapis.com/css?family=Patua+One:400" rel="stylesheet" property="stylesheet"
          type="text/css" media="all">
<?php }

function renderHeader()
{
    ?>
    <div id="header" class="header-wrapper">
        <div class="logo">
            <a href="<?php echo SECURE_PATH ?>index.html" title="Kansas Dine"><img class="logoImage"
                                                                                   src="<?php echo SECURE_PATH ?>assets/images/logo.png"
                                                                                   alt="Kansas Dine"/><img
                        class="logoImageRetina" src="<?php echo SECURE_PATH ?>assets/images/logo.png"
                        alt="Kansas Dine"/></a>
            <div class="clear"></div>
        </div>
        <div class="menu-wrapper">
            <div class="main-menu">
                <div class="menu-main-nav-menu-container">
                    <ul id="menu-main-nav-menu" class="sf-menu">
                        <li class="menu-item menu-item-home current-menu-item"><a
                                    href="<?php echo SECURE_PATH ?>">Home</a></li>
                        <li class="menu-item header-pizza"><a href="<?php echo SECURE_PATH ?>pizza/">Pizzas</a></li>
                        <li class="menu-item header-beverages" onclick="removeCurrentPageItems();$(this).addClass('current_page_item');"><a href="<?php echo SECURE_PATH ?>pizza/#beverages">Beverages</a>
                        </li>
                        <li class="menu-item header-sandwiches" onclick="removeCurrentPageItems();$(this).addClass('current_page_item');"><a href="<?php echo SECURE_PATH ?>pizza/#sandwiches">Sandwiches</a>
                        </li>
                        <li class="menu-item header-burgers"
                            onclick="removeCurrentPageItems();$(this).addClass('current_page_item');"><a
                                    href="<?php echo SECURE_PATH ?>pizza/#burgers">Burgers</a></li>
                        <li class="menu-item header-cart"><a href="<?php echo SECURE_PATH ?>cart/">Cart</a></li>
                        <li class="menu-item header-orders"><a href="<?php echo SECURE_PATH ?>orders/">My Orders</a>
                        </li>
                        <li class="menu-item header-burgers"><a href="<?php echo SECURE_PATH ?>logout/">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="menu-icons-inside">
                <div class="menu-icon menu-icon-mobile"><span class="menu-icon-create"></span></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="footer">
            <div class="footer-content">
                All Rights Reserved @ Kansas Dine 2021
            </div>
        </div>
    </div>
    <script>
        function removeCurrentPageItems() {
            $('.current_page_item').each(function(){
                $(this).removeClass('current_page_item');
        })
        }
    </script>

    <div class="mobile-menu-wrapper">
        <div class="menu-main-nav-menu-container">
            <ul id="menu-main-nav-menu-1" class="mobile-menu">
                <li class="menu-item menu-item-home current-menu-items current_page_item"><a
                            href="<?php echo SECURE_PATH ?>">Home</a></li>
                <li class="menu-item"><a href="<?php echo SECURE_PATH ?>pizza/">Pizzas</a></li>
                <li class="menu-item header-beverages"><a href="#beverages">Beverages</a></li>
                <li class="menu-item header-sandwiches"><a href="#sandwiches">Sandwiches</a></li>
                <li class="menu-item header-burgers"><a href="#burgers">Burgers</a></li>
                <li class="menu-item header-cart"><a href="<?php echo SECURE_PATH ?>cart/">Cart</a></li>
                <li class="menu-item header-orders"><a href="<?php echo SECURE_PATH ?>orders/">My Orders</a></li>
                <li class="menu-item header-burgers"><a href="<?php echo SECURE_PATH ?>logout/">Logout</a></li>
            </ul>
        </div>
    </div>
    <div id="formLoader"
         style="display: none;height:100%;width: 100%;position: fixed;background: rgba(0,  0,  0,  0.75);z-index: 1000">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             style="margin: 20% 50%; display: block;" width="100px" height="100px" viewBox="0 0 100 100"
             preserveAspectRatio="xMidYMid">
            <g>
                <circle cx="73.801" cy="68.263" fill="#e15b64" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s" begin="0s"></animateTransform>
                </circle>
                <circle cx="68.263" cy="73.801" fill="#f47e60" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s"
                                      begin="-0.062s"></animateTransform>
                </circle>
                <circle cx="61.481" cy="77.716" fill="#f8b26a" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s"
                                      begin="-0.125s"></animateTransform>
                </circle>
                <circle cx="53.916" cy="79.743" fill="#abbd81" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s"
                                      begin="-0.187s"></animateTransform>
                </circle>
                <circle cx="46.084" cy="79.743" fill="#849b87" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s"
                                      begin="-0.25s"></animateTransform>
                </circle>
                <circle cx="38.519" cy="77.716" fill="#6492ac" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s"
                                      begin="-0.312s"></animateTransform>
                </circle>
                <circle cx="31.737" cy="73.801" fill="#637cb5" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s"
                                      begin="-0.375s"></animateTransform>
                </circle>
                <circle cx="26.199" cy="68.263" fill="#6a63b6" r="3">
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline"
                                      values="0 50 50;360 50 50" times="0;1" keySplines="0.5 0 0.5 1"
                                      repeatCount="indefinite" dur="1.4925373134328357s"
                                      begin="-0.437s"></animateTransform>
                </circle>
                <animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 50 50;0 50 50"
                                  times="0;1" keySplines="0.5 0 0.5 1" repeatCount="indefinite"
                                  dur="1.4925373134328357s"></animateTransform>
            </g>
        </svg>
    </div>
<?php }

function renderToppingsModal()
{ ?>

<?php }

function footer()
{

}

function jsFiles()
{ ?>
    <script type="text/javascript" src="<?php echo SECURE_PATH ?>cdn/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo SECURE_PATH ?>assets/js/ajaxfunction.js"></script>
    <!--    <script type="text/javascript" src="--><?php //echo SECURE_PATH
    ?><!--cdn/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="<?php echo SECURE_PATH ?>cdn/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo SECURE_PATH ?>cdn/js/popper.min.js"></script>
    <script type='text/javascript'
            src='http://maps.google.com/maps/api/js?key=AIzaSyD3rVzWhxb6EGiqAD9HSrKb22gTo2HTqoA&amp;ver=1.0'></script>
    <script type='text/javascript' src='<?php echo SECURE_PATH ?>assets/js/jquery.mobilemenu.js'></script>
    <script type='text/javascript' src='<?php echo SECURE_PATH ?>assets/js/custom.js'></script>
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
    </script>
<?php }

?>
//custom.js

let cart = [];
let SECURE_PATH = 'http://localhost/restaurant/';

function changeCount(type, id, value, pizzatype,category, size, crust, sauce, cheese) {
    value = parseInt(value);
    let cartMessage = $('#cartSuccessMessage');
    let cartCount = $('#cartCount');
    if (value >= 0) {
        if (type == 'add') {
            value++;
            $('#' + id).val(value);
            //update cart
            cart.push({
                type, id, value, pizzatype,category, size, crust, sauce, cheese
            });
            cartMessage.html('<h6 class="alert alert-success">Item added to cart <i class="fa fa-check"></i></h6>');
            cartCount.html(cart.length);
        } else {
            cartMessage.html('<h6 class="alert alert-danger">Item Removed From cart <i class="fa fa-check"></i></h6>');
            if (value >= 1) {
                value--;
                $('#' + id).val(value);
                //update cart
                cart.pop();
                cartCount.html(cart.length);
            }
        }
        //insert into cart
        setState('test',SECURE_PATH+'ajax/ajax.php','updateCart=1&category=1&itemname='+pizzatype+'&size='+size+'&crust='+crust+'&sauce='+sauce+'&cheese='+cheese+'&quantity='+value);
    } else {
        $('#' + id).val(0);
    }
}
function changeBeveragesCount(type, beveragetype,id, value) {
    value = parseInt(value);
    console.log({type, beveragetype,id, value});
    let cartMessage = $('#cartSuccessMessage');
    let cartCount = $('#cartCount');
    if (value >= 0) {
        if (type == 'add') {
            value++;
            $('#' + id).val(value);
            //update cart
            cart.push({
                beveragetype
            });
            cartMessage.html('<h6 class="alert alert-success">Item added to cart <i class="fa fa-check"></i></h6>');
            cartCount.html(cart.length);
            // setTimeout(function (){
            //     cartMessage.html('');
            // },2000);
        } else {
            cartMessage.html('<h6 class="alert alert-danger">Item Removed From cart <i class="fa fa-check"></i></h6>');
            // setTimeout(function (){
            //     $('#cartSuccessMessage').html('');
            // },2000);
            if (value >= 1) {
                value--;
                $('#' + id).val(value);
                //update cart
                cart.pop();
                cartCount.html(cart.length);
            }
        }
        setState('test',SECURE_PATH+'ajax/ajax.php','updateCart=1&category=2&itemname='+beveragetype+'&quantity='+value);
    } else {
        $('#' + id).val(0);
    }
}
function changeSandwichesCount(type, sandwichtype,id, value) {
    value = parseInt(value);
    console.log({type, sandwichtype,id, value});
    let cartMessage = $('#cartSuccessMessage');
    let cartCount = $('#cartCount');
    if (value >= 0) {
        if (type == 'add') {
            value++;
            $('#' + id).val(value);
            //update cart
            cart.push({
                id
            });
            cartMessage.html('<h6 class="alert alert-success">Item added to cart <i class="fa fa-check"></i></h6>');
            cartCount.html(cart.length);
            // setTimeout(function (){
            //     cartMessage.html('');
            // },2000);
        } else {
            cartMessage.html('<h6 class="alert alert-danger">Item Removed From cart <i class="fa fa-check"></i></h6>');
            // setTimeout(function (){
            //     $('#cartSuccessMessage').html('');
            // },2000);
            if (value >= 1) {
                value--;
                $('#' + id).val(value);
                //update cart
                cart.pop();
                cartCount.html(cart.length);
            }
        }
        setState('test',SECURE_PATH+'ajax/ajax.php','updateCart=1&category=3&itemname='+sandwichtype+'&quantity='+value);
    } else {
        $('#' + id).val(0);
    }
}
function changeBurgersCount(type, burgertype,id, value) {
    value = parseInt(value);
    console.log({type, burgertype,id, value});
    let cartMessage = $('#cartSuccessMessage');
    let cartCount = $('#cartCount');
    if (value >= 0) {
        if (type == 'add') {
            value++;
            $('#' + id).val(value);
            //update cart
            cart.push({
                id
            });
            cartMessage.html('<h6 class="alert alert-success">Item added to cart <i class="fa fa-check"></i></h6>');
            cartCount.html(cart.length);
            // setTimeout(function (){
            //     cartMessage.html('');
            // },2000);
        } else {
            cartMessage.html('<h6 class="alert alert-danger">Item Removed From cart <i class="fa fa-check"></i></h6>');
            // setTimeout(function (){
            //     $('#cartSuccessMessage').html('');
            // },2000);
            if (value >= 1) {
                value--;
                $('#' + id).val(value);
                //update cart
                cart.pop();
                cartCount.html(cart.length);
            }
        }
        setState('test',SECURE_PATH+'ajax/ajax.php','updateCart=1&category=4&itemname='+burgertype+'&quantity='+value);
    } else {
        $('#' + id).val(0);
    }
}
function viewCart() {
    $('#cartModal').modal('show');
    console.log(cart);
    var data = { "updateCart" : 1,cart: cart};
    $.ajax({
        type: 'post',
        url: SECURE_PATH+'ajax/ajax.php',
        data: JSON.stringify(data),
        contentType: "application/json; charset=utf-8",
        traditional: true,
        success: function (data) {
            if (data.includes('failed'))
            {
                $('#cart_body').html('No items in the cart');
            }
            else{
                $('#cart_body').html(data);
            }
        }
    })
}
function placeOrder(cart)
{
    console.log(cart);
}
/* Mobile menu START */
$(document).ready(function($){
    "use strict";
    var slide = false;
    $(".menu-icon-mobile").on( "click", function() {

        if (slide == false) {
            $(".mobile-menu-wrapper").slideDown("slow");
            $(".menu-icon.menu-icon-mobile").addClass("opened");
            slide = true;
        }
        else {
            $(".mobile-menu-wrapper").slideUp("slow");
            $(".menu-icon.menu-icon-mobile").removeClass("opened");
            slide = false;
        }
    });
    $(".mobile-menu-wrapper a").on( "click", function() {
        if (slide == false) {
            $(".mobile-menu-wrapper").slideDown("slow");
            $(".menu-icon.menu-icon-mobile").addClass("opened");
            slide = true;
        }
        else {
            $(".mobile-menu-wrapper").slideUp("slow");
            $(".menu-icon.menu-icon-mobile").removeClass("opened");
            slide = false;
        }
    });



});
/* Mobile menu END */




function goBack() {
    window.history.back();
}


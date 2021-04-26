<?php
include ('./include/database.php');

$size = [1,2,3];
$crust = [1,2,3,4];


$getType = $database->connection->prepare("select * from pizza_types order by category");
$getType ->execute();

while($getTypes = $getType->fetch(PDO::FETCH_ASSOC))
{
    $bind_array['category'] = $getTypes['category'];
    $bind_array['type'] = $getTypes['id'];

    for($i = 0;$i<count($crust);$i++) {
        $bind_array['crust'] = $crust[$i];
        for($j = 0;$j<count($size);$j++) {
            //generate a random price
            $price = mt_rand(5, 120);

            $bind_array['size'] = $size[$j];
            $bind_array['price'] = $price;

            $insert = $database->connection->prepare("insert into pizza_prices values (NULL,:category,:type,:size,:crust,:price)");
            $insert->execute($bind_array);
        }
    }
}
?>
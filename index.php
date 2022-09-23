<?php

require_once 'vendor/autoload.php';
use Vannghia\DesignPattern\Data;
$faker = new Data('vi_VN');
$callback = function ( $string){
    return str_starts_with($string,'N');
};
$lastName = $faker->modifierValidLastName($callback);
echo $lastName;
print_r($faker->createInforPerson());

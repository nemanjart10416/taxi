<?php

require_once 'vendor/autoload.php';
//include_once("../../assets/php/funkcije.php");

//administrators
/*
 * original administrators
 * username: selena
 * password hash: $2y$10$AuaepQvBb5Iclv4TO7aEoOYgjvrsIhyKnP5A6TkZa2CYTjDMLdPXC
 * salt
 * */
function add_admins($number){
    $faker = Faker\Factory::create();
    $password = "administrator";
    $salt = "asd123";
    $count = 0;

    for($i =0;$i<$number;$i++){
        $username = "test_".$faker->userName();
        $name = "test_".$faker->name();
        $lname = "test_".$faker->lastName();
        $email = "test_".$faker->email();
        $mobile = $faker->phoneNumber();

        $ans = Admin::create($username,$password,$salt,$name,$lname,$email,$mobile);
        if($ans === true){
            $count++;
        }else{
            return danger($ans);
        }
    }

    return success($count." admins added");
}

function add_drivers($number){
    $faker = Faker\Factory::create();
    $password = "driver";
    $salt = "asd123";
    $count = 0;

    for($i =0;$i<$number;$i++){
        $username = "test_".$faker->userName();
        $name = "test_".$faker->name();
        $lname = "test_".$faker->lastName();
        $email = "test_".$faker->email();
        $mobile = $faker->phoneNumber();

        $ans = Driver::create($username,$password,$salt,$name,$lname,$email,$mobile);
        if($ans === true){
            echo $count++;
        }else{
            echo danger($ans);
        }
    }

    return success($count." drivers added");
}

function add_new_rides($number){
    $faker = Faker\Factory::create();
    $count = 0;

    for($i =0;$i<$number;$i++){
        $name = "test_".$faker->name();
        $email = "test_".$faker->email();
        $comment = $faker->realText(30);

        if($i%2==0){
            $from_to = "to";
        }else{
            $from_to = "from";
        }

        $number_people = 1;
        $number_suitcases = 1;
        $number_of_child_seats = 1;
        $streets_id = 1;
        $street_number = 23;
        $payment = "cash";
        $price = 35;


        //2023-02-25 21:14:12
        $ride_time = date('Y-m-d h:m:s', time()+ 86400);


        $mobile = $faker->phoneNumber();
        $aa1 = "";
        $aa2 = "";

        Ride::add($name,$email,$mobile,$from_to,$number_people,$number_suitcases,$number_of_child_seats,$streets_id,$street_number,$payment,$price,$ride_time,$comment,$aa1,$aa2);
    }

    return success("rides added as new ride");
}

//rides
/*
for($i =0;$i<10;$i++){
    $name = $faker->name();
    $email = $faker->email();
    $comment = "test comment";

    if($i%2==0){
        $from_to = "to";
    }else{
        $from_to = "from";
    }

    $number_people = 1;
    $number_suitcases = 2;
    $number_of_child_seats = 3;
    $streets_id = 1;
    $street_number = 23;
    $payment = "cash";
    $price = 35;


    $date = $faker->date("Y-m-d");
    $time = $faker->time("H:i:s");

    $ride_time = $date." ".$time;


    $mobile = $faker->phoneNumber();
    $aa1 = "";
    $aa2 = "";

    $ans = Ride::add($name,$email,$mobile,$from_to,$number_people,$number_suitcases,$number_of_child_seats,$streets_id,$street_number,$payment,$price,$ride_time,$comment,$aa1,$aa2);
    echo $ans."<hr>";
}
*/

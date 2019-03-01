<?php

$redis = new Redis();

$redis->connect('127.0.0.1',6379);

$phone = [];

for($i=0; $i<10000; $i++){
	$num = rand(0,10000);

	$phone[]=$num;
}

print_r($phone);
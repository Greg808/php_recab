<?php

use Exercise\Service\Container;

require __DIR__ . '/bootstrap.php';

$container = new Container($configuration);
$salesHtmlFormatter = $container->getSalesHtmlOutput();

// $salesFaker */$salesFaker = $container->getSalesFaker();
//$response = $salesFaker->create(100);
// echo $response;

echo $container->getSalesReporter()->betweenDate('2012-04-28 03:01:37', '2020-10-03 19:30:31', $salesHtmlFormatter);








<?php

use Exercise\BadSingleResponsibility\SalesReporter;
use Exercise\Service\Container;

require __DIR__ . '/bootstrap.php';

$container = new Container($configuration);
$salesHtmlFormatter = $container->getSalesHtmlOutput();
// $salesFaker */$salesFaker = $container->getSalesFaker();
//$response = $salesFaker->create(100);
// echo $response;

echo '<h1>Single Responsibility Output</h1>';
echo '<h2>Output Good Example</h2>';
echo $container->getSalesReporter()->betweenDate('2012-04-28 03:01:37', '2020-10-03 19:30:31', $salesHtmlFormatter);


echo '<h2>Output Bad Example</h2>';
$salesReporter = new SalesReporter($configuration);
echo $salesReporter->between('2012-04-28 03:01:37','2020-10-03 19:30:31');








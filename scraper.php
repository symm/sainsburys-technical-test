<?php
declare(strict_types = 1);

use Symm\GroceryApp;

require_once('vendor/autoload.php');

$app = GroceryApp::build();
echo $app->getProductsAsJsonString(
    "http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html"
);
echo PHP_EOL;

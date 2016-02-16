<?php
declare(strict_types = 1);

namespace Symm\Parsers;

use Symm\Models\ProductCollection;

interface ProductPageParser
{
    public function getProducts(string $productListUrl) : ProductCollection;
}
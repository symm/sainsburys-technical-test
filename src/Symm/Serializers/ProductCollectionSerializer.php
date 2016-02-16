<?php
declare(strict_types = 1);

namespace Symm\Serializers;

use Symm\Models\ProductCollection;

interface ProductCollectionSerializer
{
    public function serialize(ProductCollection $productCollection) : string;
}
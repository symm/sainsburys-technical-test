<?php
declare(strict_types = 1);

namespace Symm\Serializers;

use Symm\Exceptions\SerializationException;
use Symm\Models\ProductCollection;

class ProductCollectionToJson implements ProductCollectionSerializer
{
    public function serialize(ProductCollection $productCollection) : string
    {
        $json = json_encode($productCollection, JSON_PRETTY_PRINT );

        if ($json === false) {
            throw new SerializationException(json_last_error_msg(), json_last_error());
        }

        return $json;
    }
}
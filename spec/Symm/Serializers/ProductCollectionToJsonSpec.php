<?php

namespace spec\Symm\Serializers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symm\Exceptions\SerializationException;
use Symm\Models\Product;
use Symm\Models\ProductCollection;
use Symm\Serializers\ProductCollectionToJson;

/**
 * @mixin ProductCollectionToJson
 */
class ProductCollectionToJsonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductCollectionToJson::class);
    }

    function it_should_serialize_a_collection_of_products()
    {
        $productCollection = new ProductCollection();
        $productCollection->add(
            new Product(
                "Sainsbury's Avocado, Ripe & Ready x2",
                90600,
                "1.80",
                "Great to eat now - refrigerate at home 1 of 5 a day 1 counts as 1 of your 5..."
            )
        );

        $expected = '{
    "results": [
        {
            "title": "Sainsbury\'s Avocado, Ripe & Ready x2",
            "size": "90.6kb",
            "unit_price": "1.80",
            "description": "Great to eat now - refrigerate at home 1 of 5 a day 1 counts as 1 of your 5..."
        }
    ],
    "total": "1.80"
}';
        $this->serialize($productCollection)->shouldReturn($expected);
    }

    function it_should_throw_an_exception_if_the_collection_cant_be_serialized()
    {
        $products= new ProductCollection();
        $products->add(
            new Product(
                "\xB1\x31",
                90600,
                1.80,
                "\xB1\x31"
            )
        );

        $this->shouldThrow(SerializationException::class)->during('serialize', [$products]);
    }

}

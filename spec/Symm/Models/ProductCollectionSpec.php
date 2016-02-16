<?php

namespace spec\Symm\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symm\Models\Product;
use Symm\Models\ProductCollection;

/**
 * @mixin ProductCollection
 */
class ProductCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ProductCollection::class);
    }

    function it_is_countable()
    {
        $this->count()->shouldReturn(0);
    }

    function it_can_have_things_added_to_it()
    {
        $this->add($this->getDummyProduct())->shouldReturn($this);
        $this->shouldHaveCount(1);
    }

    function it_is_iterable()
    {
        $this->shouldHaveType('\IteratorAggregate');
        $this->add($this->getDummyProduct());

        $this->getIterator()->shouldBeLike(new \ArrayIterator([$this->getDummyProduct()]));
    }

    function it_implements_serializable_interface()
    {
        $this->shouldHaveType('\JsonSerializable');

        $this->jsonSerialize()->shouldBeArray();
        $this->jsonSerialize()->shouldHaveCount(2);
        $this->jsonSerialize()->shouldHaveKeyWithValue('total', "0.00");
        $this->jsonSerialize()->shouldHaveKeyWithValue('results', []);
    }

    public function getDummyProduct() : Product
    {
        return new Product(
            "Sainsbury's Avocado, Ripe & Ready x2",
            90600,
            (double) 1.80,
            "Great to eat now - refrigerate at home 1 of 5 a day 1 counts as 1 of your 5..."
        );
    }
}

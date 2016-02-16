<?php

namespace spec\Symm\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symm\Models\Product;

/**
 * @mixin Product
 */
class ProductSpec extends ObjectBehavior
{
    private $title       = "Sainsbury's Avocado, Ripe & Ready x2";
    private $size        = 90600;
    private $price       = 1.80;
    private $description = "Great to eat now - refrigerate at home 1 of 5 a day 1 counts as 1 of your 5...";

    function let()
    {
        $this->beConstructedWith(
            $this->title,
            $this->size,
            $this->price,
            $this->description
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Product::class);
    }

    function it_has_a_title()
    {
        $this->getTitle()->shouldReturn($this->title);
    }

    function it_has_a_size()
    {
        $this->getSize()->shouldReturn($this->size);
    }

    function it_has_a_price()
    {
        $this->getPrice()->shouldReturn($this->price);
    }

    function it_has_a_description()
    {
        $this->getDescription()->shouldReturn($this->description);
    }

    function it_should_implement_json_serializable_interface()
    {
        $this->shouldHaveType('\JsonSerializable');

        $this->jsonSerialize()->shouldReturn(
            [
                'title'       => $this->title,
                'size'        => ($this->size / 1000) . "kb",
                'unit_price'  => number_format($this->price, 2),
                'description' => $this->description
            ]
        );
    }
}

<?php

namespace spec\Symm\Exceptions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symm\Exceptions\SerializationException;

class SerializationExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SerializationException::class);
    }

    function it_should_extend_exception()
    {
        $this->shouldHaveType('\Exception');
    }
}

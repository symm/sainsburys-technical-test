<?php

namespace spec\Symm\Exceptions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HttpClientExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Symm\Exceptions\HttpClientException');
    }

    function it_should_extend_exception()
    {
        $this->shouldHaveType('\Exception');
    }
}

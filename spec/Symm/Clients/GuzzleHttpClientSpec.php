<?php

namespace spec\Symm\Clients;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symm\Clients\GuzzleHttpClient;
use Symm\Exceptions\HttpClientException;

/**
 * @mixin GuzzleHttpClient
 */
class GuzzleHttpClientSpec extends ObjectBehavior
{
    private $url  = "http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html";

    function let(ClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GuzzleHttpClient::class);
    }

    function it_returns_the_page_contents_as_a_string(ClientInterface $client)
    {
        $body = "Hello world!";

        $client->request("GET", $this->url)->willReturn(
            new Response(200, [], $body)
        );

        $this->fetch($this->url)->shouldReturn($body);
    }

    function it_throws_exception_if_there_is_a_server_error(ClientInterface $client)
    {
        $client->request("GET", $this->url)->willReturn(
            new Response(500, [], "Internal Server Error")
        );

        $this->shouldThrow(HttpClientException::class)->during('fetch', [$this->url]);
    }
}

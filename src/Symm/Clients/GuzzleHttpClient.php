<?php
declare(strict_types = 1);

namespace Symm\Clients;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

use Symm\Exceptions\HttpClientException;

class GuzzleHttpClient implements HttpClient
{
    private $guzzle;

    public function __construct(ClientInterface $guzzle) {

        $this->guzzle = $guzzle;
    }

    public function fetch($url) : string
    {
        $response = $this->guzzle->request('GET', $url);

        if (!$this->isSuccessful($response)) {
            throw new HttpClientException($response->getReasonPhrase());
        }

       return $response->getBody()->__toString();
    }

    private function isSuccessful(Response $response) {
        return ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300);
    }
}

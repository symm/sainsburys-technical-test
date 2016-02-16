<?php
declare(strict_types = 1);

namespace Symm;

use GuzzleHttp\Client;

use Symm\Clients\GuzzleHttpClient;
use Symm\Parsers\ProductPageDomCrawler;
use Symm\Parsers\ProductPageParser;
use Symm\Serializers\ProductCollectionSerializer;
use Symm\Serializers\ProductCollectionToJson;

class GroceryApp
{
    private $parser;
    private $serializer;

    public function __construct(ProductPageParser $parser, ProductCollectionSerializer $serializer)
    {
        $this->parser     = $parser;
        $this->serializer = $serializer;
    }

    public static function build() : GroceryApp
    {
        $client     = new GuzzleHttpClient(new Client());
        $parser     = new ProductPageDomCrawler($client);
        $serializer = new ProductCollectionToJson();

        return new self($parser, $serializer);
    }

    public function getProductsAsJsonString($url) : string
    {
        $products = $this->parser->getProducts($url);

        return $this->serializer->serialize($products);
    }
}
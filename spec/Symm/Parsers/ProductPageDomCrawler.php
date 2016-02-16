<?php

namespace spec\Symm\Parsers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symm\Clients\HttpClient;
use Symm\Models\Product;
use Symm\Models\ProductCollection;

/**
 * @mixin ProductPageDomCrawler
 */
class ProductPageDomCrawler extends ObjectBehavior
{
    function let(HttpClient $httpClient)
    {
        $this->beConstructedWith($httpClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductPageDomCrawler::class);
    }

    function it_should_return_a_collection_of_products(HttpClient $httpClient)
    {
        $this->setupMockServerResponses($httpClient);

        $products = $this->getProducts(
            "http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html"
        );

        $products->shouldHaveType(ProductCollection::class);
        $products->shouldHaveCount(7);

        $products->shouldBeLike($this->getExpectedProducts());
    }

    private function setupMockServerResponses(HttpClient $httpClient)
    {
        $baseUrl = "http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape";
        $mockDir = __DIR__ . '/../../../mocks';

        $httpClient->fetch($baseUrl . "/5_products.html")->willReturn(
            file_get_contents($mockDir . '/5_products.html')
        );

        $httpClient->fetch($baseUrl . "/sainsburys-apricot-ripe---ready-320g.html")->willReturn(
            file_get_contents($mockDir . '/sainsburys-apricot-ripe---ready-320g.html')
        );
        $httpClient->fetch($baseUrl . "/sainsburys-avocado-xl-pinkerton-loose-300g.html")->willReturn(
            file_get_contents($mockDir . '/sainsburys-avocado-xl-pinkerton-loose-300g.html')
        );
        $httpClient->fetch($baseUrl . "/sainsburys-avocado--ripe---ready-x2.html")->willReturn(
            file_get_contents($mockDir . '/sainsburys-avocado--ripe---ready-x2.html')
        );
        $httpClient->fetch($baseUrl . "/sainsburys-avocados--ripe---ready-x4.html")->willReturn(
            file_get_contents($mockDir . '/sainsburys-avocados--ripe---ready-x4.html')
        );
        $httpClient->fetch($baseUrl . "/sainsburys-conference-pears--ripe---ready-x4-%28minimum%29.html")->willReturn(
            file_get_contents($mockDir . '/sainsburys-conference-pears--ripe---ready-x4-(minimum).html')
        );
        $httpClient->fetch($baseUrl . "/sainsburys-golden-kiwi--taste-the-difference-x4-685641-p-44.html")->willReturn(
            file_get_contents($mockDir . '/sainsburys-golden-kiwi--taste-the-difference-x4-685641-p-44.html')
        );
        $httpClient->fetch($baseUrl . "/sainsburys-kiwi-fruit--ripe---ready-x4.html")->willReturn(
            file_get_contents($mockDir . '/sainsburys-kiwi-fruit--ripe---ready-x4.html')
        );
    }

    private function getExpectedProducts()
    {
        $products = new ProductCollection();

        $products->add(new Product("Sainsbury's Apricot Ripe & Ready x5", 39185, 3.50, "Apricots"));
        $products->add(new Product("Sainsbury's Avocado Ripe & Ready XL Loose 300g", 39597, 1.50, "Avocados"));
        $products->add(new Product("Sainsbury's Avocado, Ripe & Ready x2",44479, 1.80, "Avocados"));
        $products->add(new Product("Sainsbury's Avocados, Ripe & Ready x4", 39610, 3.20, "Avocados"));
        $products->add(new Product("Sainsbury's Conference Pears, Ripe & Ready x4 (minimum)", 39465, 1.50, 'Conference'));
        $products->add(new Product("Sainsbury's Golden Kiwi x4", 39485, 1.80, 'Gold Kiwi'));
        $products->add(new Product("Sainsbury's Kiwi Fruit, Ripe & Ready x4", 39911,1.80,'Kiwi'));

        return $products;
    }
}

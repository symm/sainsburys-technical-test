<?php
declare(strict_types = 1);

namespace Symm\Parsers;

use Symfony\Component\DomCrawler\Crawler;

use Symm\Clients\HttpClient;
use Symm\Models\Product;
use Symm\Models\ProductCollection;

class ProductPageDomCrawler implements ProductPageParser
{
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getProducts(string $productListUrl) : ProductCollection
    {
        $productListContents = $this->httpClient->fetch($productListUrl);
        $crawler             = new Crawler($productListContents);
        $products            = new ProductCollection();

        $crawler->filter('.product')->each(function(Crawler $crawler) use ($products){
            $title = trim($crawler->filter('.productInfo > h3 > a')->eq(0)->text());
            $price = $crawler->filter('.pricePerUnit')->eq(0)->text();
            $price = preg_replace("/[^0-9.]/", '', $price);

            $productLink = $crawler->filter('h3 > a')->eq(0)->attr('href');
            $productPage = $this->httpClient->fetch($productLink);
            $pageCrawler = new Crawler($productPage);

            $description = trim($pageCrawler->filter('.productText')->eq(0)->text());

            $products->add(new Product(
                $title,
                strlen($productPage),
                (float) $price,
                $description
            ));
        });

        return $products;
    }
}

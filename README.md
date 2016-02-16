# Sainsbury’s Product scaper

![PHP](https://raw.githubusercontent.com/T1st3/vendor-icons/master/dist/64x64/php.png)
![Composer](https://raw.githubusercontent.com/T1st3/vendor-icons/master/dist/64x64/composer.png)
![Symfony](https://raw.githubusercontent.com/T1st3/vendor-icons/master/dist/64x64/symfony.png)

## Getting started

Please ensure you have [composer](https://getcomposer.org/) installed and are running PHP 7.0+

```
php composer-setup.php
```

Then install the dependencies:

```
./composer.phar install
```

Alternatively, if you have [docker](https://www.docker.com/) installed, build and run the container

```
docker build -t scraper . && docker run --rm scraper
```

## Running the test suite

Unit tests:

```
./bin/phpspec run
```

## Running the app

```
php scraper.php
```

## Design

### GroceryApp

Is a facade with a single static method for building a version of the app with dependencies already injected.

The GroceryApp depends on two interfaces, the `ProductPageParser` and the `ProductCollectionSerializer`

### ProductPageParser

Is responsible for taking a product listing page url, reading the contents and returning a `ProductCollection` model.

The implementation `ProductPageDomCrawler` has a dependency on the `HttpClient` interface which it uses to fetch
the listing page and subsequent product pages. Page contents are parsed using the Symfony DomCrawler component.

### HttpClient

Is responsible for fetching a URL and returning the page body as a string.

The implementation `GuzzleHttpClient` wraps the Guzzle library to do this.

### ProductCollectionSerializer

Is responsible for taking a `ProductCollection` model and converting it to the desired output format.

The implementation `ProductCollectionToJson` wraps PHP's built in `json_encode` function to generate
JSON output for this task.

![Diagram](https://bitbucket.org/gazj/grocery-scraper/raw/master/diagram.png)

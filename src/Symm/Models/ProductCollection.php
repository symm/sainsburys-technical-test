<?php
declare(strict_types = 1);

namespace Symm\Models;

class ProductCollection implements \JsonSerializable, \Countable, \IteratorAggregate
{
    /**
     * @var Product[] $products
     */
    private $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function add(Product $product) : ProductCollection
    {
        $this->products[] = $product;

        return $this;
    }

    public function count() : int
    {
        return count($this->products);
    }

    public function jsonSerialize() : array
    {
        return [
            'results' => $this->products,
            'total'   => number_format($this->calculateTotal(), 2)
        ];
    }

    private function calculateTotal() : float
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total = $total + $product->getPrice();
        }

        return $total;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->products);
    }
}

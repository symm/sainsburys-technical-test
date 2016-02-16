<?php
declare(strict_types = 1);

namespace Symm\Models;

class Product implements \JsonSerializable
{
    private $title;
    private $size;
    private $price;
    private $description;

    public function __construct(string $title, int $pageSize, float $price, string $description)
    {
        $this->title       = $title;
        $this->size        = $pageSize;
        $this->price       = $price;
        $this->description = $description;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getSize() : int
    {
        return $this->size;
    }

    public function getPrice() : float
    {
        return $this->price;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function jsonSerialize() : array
    {
        return [
            'title'       => $this->title,
            'size'        => $this->formatBytes($this->size, 2),
            'unit_price'  => number_format($this->price, 2),
            'description' => $this->description
        ];
    }

    private function formatBytes($bytes, $scale) {
        $base = log($bytes, 1000);
        $suffixes = array('', 'kb', 'mb', 'gb', 'tb');

        return round(pow(1000, $base - floor($base)), $scale) . $suffixes[floor($base)];
    }

}

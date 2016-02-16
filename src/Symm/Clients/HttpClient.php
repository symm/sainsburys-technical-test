<?php
declare(strict_types = 1);

namespace Symm\Clients;

interface HttpClient
{
    public function fetch($url) : string;
}
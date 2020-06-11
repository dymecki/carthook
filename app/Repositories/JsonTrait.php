<?php

declare(strict_types = 1);

namespace App\Repositories;

use Psr\Http\Message\StreamInterface;
use function collect;
use function is_array;
use function json_decode;
use function json_encode;

trait JsonTrait
{
    public function decode(StreamInterface $data)
    {
        try {
            $result = json_decode((string) $data, false, 512, JSON_THROW_ON_ERROR);
        }
        catch (\JsonException $e) {
            $result = [];
        }

        $result = is_array($result) ? $result : [$result];

        return collect($result);
    }

    public function encode(array $json): string
    {
        try {
            $result = json_encode($json, JSON_THROW_ON_ERROR);
        }
        catch (\JsonException $e) {
            $result = '';
        }

        return $result;
    }
}
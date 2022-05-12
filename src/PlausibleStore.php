<?php

namespace Kilobyteno\PlausibleTile;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Dashboard\Models\Tile;

class PlausibleStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("plausible");
    }

    public function setData(string $domain, array $data): Tile
    {
        return $this->tile->putData("data", Arr::add($this->tile->getData('data'), Str::replace('.', '_', $domain), $data));
    }

    public function getData(string $domain): array
    {
        return $this->tile->getData('data')[Str::replace('.', '_', $domain)] ?? [];
    }

    public function getAll(): array
    {
        return$this->tile->getData('data') ?? [];
    }
}

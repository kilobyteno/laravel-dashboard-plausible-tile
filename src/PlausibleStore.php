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
        $domain_key = Str::replace('.', '_', $domain);
        $old_data = $this->tile->getData('data');
        Arr::forget($old_data, $domain_key);
        $new_data = Arr::add($old_data, $domain_key, $data);
        return $this->tile->putData("data", $new_data);
    }

    public function getData(string $domain): array
    {
        return $this->tile->getData('data')[Str::replace('.', '_', $domain)] ?? [];
    }

    public function getAll(): array
    {
        return $this->tile->getData('data') ?? [];
    }
}

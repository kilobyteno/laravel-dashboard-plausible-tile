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

    /**
     * @param string $domain
     * @param array $data
     * @return Tile
     */
    public function setData(string $domain, array $data): Tile
    {
        $domain_key = Str::replace('.', '_', $domain);
        $old_data = $this->tile->getData('data');
        if(Arr::has($old_data, $domain_key)) {
            Arr::forget($old_data, $domain_key);
        }
        $new_data = Arr::add($old_data, $domain_key, $data);

        return $this->tile->putData("data", $new_data);
    }

    /**
     * @param string $domain
     * @return array
     */
    public function getData(string $domain): array
    {
        return $this->tile->getData('data')[Str::replace('.', '_', $domain)] ?? [];
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->tile->getData('data') ?? [];
    }
}

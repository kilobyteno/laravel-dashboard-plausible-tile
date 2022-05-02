<?php

namespace Kilobyteno\PlausibleTile;

use Livewire\Component;

class PlausibleTileComponent extends Component
{
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-plausible-tile::tile', [
            'data' => PlausibleStore::make()->getAll(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.plausible.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}

<?php

namespace Kilobyteno\PlausibleTile;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PlausibleTileComponent extends Component
{
    public string $position;

    /**
     * @param string $position
     * @return void
     */
    public function mount(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('dashboard-plausible-tile::tile', [
            'data' => PlausibleStore::make()->getAll(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.plausible.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}

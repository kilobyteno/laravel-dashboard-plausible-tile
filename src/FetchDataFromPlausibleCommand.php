<?php

namespace Kilobyteno\PlausibleTile;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Kilobyteno\LaravelPlausible\Exceptions\PlausibleAPIException;
use Kilobyteno\LaravelPlausible\Plausible;

class FetchDataFromPlausibleCommand extends Command
{
    protected $signature = 'dashboard:fetch-plausible-data';

    protected $description = 'Fetch Plausible data from the API';

    /**
     * @param Plausible $plausible
     * @return void
     */
    public function handle(Plausible $plausible): void
    {
        $this->info('Fetching data from Plausible...');
        $domains = config('dashboard.tiles.plausible.domains');
        if (empty($domains)) {
            $this->error('No domains configured in config/dashboard.php');

            return;
        }
        foreach ($domains as $domain) {
            $this->info("Fetching data for {$domain}");

            try {
                $data = $plausible->get($domain, '30d', Plausible::getAllowedMetrics());
                $data = Arr::add($data, 'realtime_visitors', $plausible->getRealtimeVisitors($domain));
            } catch (PlausibleAPIException $e) {
                $this->error($e->getMessage());

                return;
            }
            PlausibleStore::make()->setData($domain, $data);
        }
        $this->info('All done!');
    }
}

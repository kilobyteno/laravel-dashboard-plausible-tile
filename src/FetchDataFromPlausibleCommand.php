<?php

namespace Kilobyteno\PlausibleTile;

use Illuminate\Console\Command;
use Kilobyteno\LaravelPlausible\Plausible;

class FetchDataFromPlausibleCommand extends Command
{
    protected $signature = 'dashboard:fetch-plausible-data';

    protected $description = 'Fetch Plausible data from the API';

    public function handle(Plausible $plausible)
    {
        $this->info('Fetching data from Plausible...');
        $domains = config('dashboard.tiles.plausible.domains');
        if (empty($domains)) {
            $this->error('No domains configured in config/dashboard.php');

            return;
        }
        foreach ($domains as $domain) {
            $this->info("Fetching data for {$domain}");
            $data = $plausible->get($domain, '30d', Plausible::getAllowedMetrics());
            PlausibleStore::make()->setData($domain, $data);
        }
        $this->info('All done!');
    }
}

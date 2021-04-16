```php
<?php

namespace App\Acme;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class SalesReporter
{
    public function between($startDate, $endDate)
    {
        if (! Auth::check()) throw new Exception('Auth required');

        $sales = $this->queryDatabaseForSalesBetween($startDate, $endDate);

        return $this->format($sales);
    }

    protected function queryDatabaseForSalesBetween(Carbon $startDate, Carbon $endDate)
    {
        return collect([
                [
                    'created_at' => new Carbon('2021-03-19 14:43:40'),
                    'charge' => '211',
                ],
            ])->whereBetween('created_at', [$startDate, $endDate])->sum('charge') / 100;
    }

    protected function format(float $sales) {
        return "<h1>Sales: $sales</h1>";
    }
}

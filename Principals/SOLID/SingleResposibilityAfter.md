```php
<?php
namespace App\Acme;

use Carbon\Carbon;

// now, this class only gets the sales between the given dates.
// It doesn't deal with how with sales are stored, it doesn't
// deal with how to format the output, it doesn't deal with Auth
class SalesReporter
{
    private $repository;

    // The sales persistence uses an interface. That way we can
    // pass any class in _that matches the interface_ to tell SalesReporter
    // where to look for the data.

    // in the codwe below you can see that this example takes a SalesCollection
    // class that implements this interface, but it could be a db call (SalesRepository), or a
    // and api call (SalesByApi) or anything else
    public function __construct(SalesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function between($startDate, $endDate, SalesOutputInterface $formatter)
    {
        // now, the sales data is requested from the repository
        $sales = $this->repository->between($startDate, $endDate);

        // Now, the format is handled by a SalesOutputInterface. So long as the
        // class that is passed as the third param implements this interface, the
        // we will return a valid results. Again, this class is now no longer
        // concerned with exactly _what_ that format is. In the code below,
        // SalesHtmlOutput, that implements SalesOutputInterface, is passed.
        return $formatter->output($sales);
    }
}


// the repository interface...
interface SalesRepositoryInterface {
    public function between(Carbon $startDate, Carbon $endDate);
}

// .. and an exmaple implementation of it.
class CollectionSalesRepository implements SalesRepositoryInterface {
    public function between(Carbon $startDate, Carbon $endDate)
    {
        return collect([
                [
                    'created_at' => new Carbon('2021-03-19 14:43:40'),
                    'charge' => '2111',
                ],
            ])->whereBetween('created_at', [$startDate, $endDate])->sum('charge') / 100;
    }
}

// The formatter interface ....
interface SalesOutputInterface {
    public function output(float $sales);
}

// .. and an example implementation of it.
class SalesHtmlOutput implements SalesOutputInterface {

    public function output(float $sales)
    {
        return "<h1>Sales: $sales</h1>";
    }
}

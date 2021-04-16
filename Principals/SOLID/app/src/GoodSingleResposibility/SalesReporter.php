<?php


namespace Exercise\GoodSingleResposibility;




use Exercise\GoodSingleResposibility\Formatter\SalesOutputInterface;
use Exercise\GoodSingleResposibility\Repository\SalesRepositoryInterface;

class SalesReporter
{

    // The sales persistence uses an interface. That way we can
    // pass any class in _that matches the interface_ to tell SalesReporter
    // where to look for the data.

    // in the codwe below you can see that this example takes a SalesCollection
    // class that implements this interface, but it could be a db call (SalesRepository), or a
    // and api call (SalesByApi) or anything else
    public function __construct(private SalesRepositoryInterface $repository)
    {
    }

    /**
     * returns sells between an start and end date
     * @param string $startDate
     * @param string $endDate
     * @param SalesOutputInterface $formatter
     * @return mixed
     */
    public function betweenDate(string $startDate, string $endDate, SalesOutputInterface $formatter): mixed
    {
        $sales = $this->repository->betweenDate($startDate, $endDate);
        return $formatter->output($sales);
    }
}
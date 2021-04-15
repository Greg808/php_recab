<?php

namespace Exercise\Service;


use Exercise\Faker\FakerInterface;
use Exercise\Faker\SalesFaker;
use Exercise\Repository\CollectionSalesRepository;
use Faker\Generator;
use PDO;


class Container
{

    private $pdo;

    private $salesReporter;

    private $faker;

    private $salesFaker;


    public function __construct(private array $configuration)
    {
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_u'],
                $this->configuration['db_p']
            );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }

    public function getSalesReporter(): SalesReporter
    {
        if ($this->salesReporter === null) {

            $this->salesReporter = new SalesReporter(new CollectionSalesRepository($this->getPDO()));
        }
        return $this->salesReporter;
    }

    public function getSalesFaker(): FakerInterface
    {
        if ($this->salesFaker === null) {
            $this->salesFaker = new SalesFaker($this->getPDO(), $this->getFaker());;
        }
        return $this->salesFaker;
    }

    protected function getFaker(): Generator
    {
        if ($this->faker === null) {
            $this->faker = Factory::create();
        }
        return $this->faker;
    }
}
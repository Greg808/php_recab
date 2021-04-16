<?php

namespace Exercise\Service;


use Exercise\Faker\FakerInterface;
use Exercise\Faker\SalesFaker;
use Exercise\GoodSingleResposibility\Formatter\SalesHtmlOutput;
use Exercise\GoodSingleResposibility\Formatter\SalesOutputInterface;
use Exercise\GoodSingleResposibility\Repository\CollectionSalesRepository;
use Exercise\GoodSingleResposibility\SalesReporter;
use Faker\Factory;
use Faker\Generator;
use PDO;


class Container
{
    private ?PDO $pdo = null;

    private ?SalesReporter $salesReporter = null;

    private ?Generator $faker = null;

    private ?FakerInterface $salesFaker = null;

    private ?SalesOutputInterface $salesHtmlOutput = null;


    public function __construct(private array $configuration)
    {}

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_u'],
                $this->configuration['db_p']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    public function getSalesHtmlOutput(): SalesOutputInterface
    {
        if ($this->salesHtmlOutput === null) {

            $this->salesHtmlOutput = new SalesHtmlOutput();
        }
        return $this->salesHtmlOutput;
    }

    public function getSalesFaker(): FakerInterface
    {
        if ($this->salesFaker === null) {
            $this->salesFaker = new SalesFaker($this->getPDO(), $this->getFakerFactory());
        }
        return $this->salesFaker;
    }

    private function getFakerFactory(): Generator
    {
        if ($this->faker === null) {
            $this->faker = Factory::create();
        }
        return $this->faker;
    }
}
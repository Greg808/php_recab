<?php

namespace Exercise\BadSingleResponsibility;

use PDO;
use PDOException;



class SalesReporter
{
    private ?PDO $pdo = null;

    public function __construct(private array $configuration)
    {}

    public function between(string $startDate, string $endDate): string
    {

        $sales = $this->queryDatabaseForSalesBetween($startDate, $endDate);

        return $this->format($sales);
    }

    protected function queryDatabaseForSalesBetween($startDate, $endDate): string|int|float
    {
        $sth = $this->getPDO()->prepare("SELECT SUM(charge) FROM sales where created_at BETWEEN :startDate AND :endDate");
        $sth->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $sth->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $sth->execute();
        try {
            while ($row = $sth->fetch()) {
                $result = (int)$row['SUM(charge)'];
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $result / 100;
    }

    protected function format(float $sales): string
    {
        return "<h3>Sales: $sales</h3>";
    }

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

}
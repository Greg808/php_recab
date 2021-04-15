<?php


namespace Exercise\Repository;


class CollectionSalesRepository implements SalesRepositoryInterface
{
    public function __construct(private $pdo)
    {}

    public function betweenDate($startDate, $endDate): float
    {
        $sth = $this->pdo->prepare("SELECT SUM(charge) FROM sales where created_at BETWEEN :startDate AND :endDate");
        $sth->bindParam(':startDate', $startDate, \PDO::PARAM_STR);
        $sth->bindParam(':endDate', $endDate, \PDO::PARAM_STR);
        $sth->execute();
        try {
            while ($row = $sth->fetch()) {
                $result = (int)$row['SUM(charge)'];
            }
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
        return $result / 100;
    }

}
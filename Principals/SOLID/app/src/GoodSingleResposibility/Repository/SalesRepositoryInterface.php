<?php


 namespace Exercise\GoodSingleResposibility\Repository;


interface SalesRepositoryInterface
{
    //public function between(Carbon $startDate, Carbon $endDate);
    public function betweenDate($startDate, $endDate);
}
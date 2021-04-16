<?php


namespace Exercise\Faker;


class BaseFaker
{
    // Pass in the PDO connection and the faker library
    public function __construct(protected $pdo, protected $faker)
    {}
}
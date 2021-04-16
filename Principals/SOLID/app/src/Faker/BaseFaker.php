<?php


namespace Exercise\Faker;


class BaseFaker
{
    // Pass in the PDO connection and the faker factory
    public function __construct(protected $pdo, protected $faker)
    {}
}
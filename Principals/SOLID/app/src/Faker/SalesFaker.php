<?php

namespace Exercise\Faker;


use Faker\Factory;
use PDOException;

class SalesFaker extends BaseFaker implements FakerInterface
{
    public array $notifications;

    public function __construct(protected $pdo, protected $faker)
    {
        parent::__construct($pdo, $faker);
    }

    public function create($count): string
    {
        $faker = $this->faker;
        $pdo = $this->pdo;
        for ($i = 0; $i <= $count; $i++) {
            $description = $faker->text();
            $charge = $faker->numberBetween(500, 5500);
            $created = $faker->dateTimeBetween()->format('Y-m-d H:i:s');
            $updated = $faker->dateTimeBetween($created)->format('Y-m-d H:i:s');
            $sql = "INSERT INTO sales (description, charge, created_at, updated_at) VALUES (?, ?, ?, ?)";
            $smtp = $pdo->prepare($sql);
            try {
                $smtp->execute([$description, $charge, $created, $updated]);
            } catch (PDOException $e) {
               return $e->errorInfo;
            }
        }
        return  'success';
    }
}
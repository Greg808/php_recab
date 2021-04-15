<?php

namespace Exercise\Faker;

interface FakerInterface
{
    /**
     * @param int $count
     * @return string
     */
    public function create($count);
}
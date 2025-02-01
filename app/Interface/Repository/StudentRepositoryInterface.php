<?php

namespace App\Interface\Repository;

interface StudentRepositoryInterface
{
    public function findMany();

    public function findOneById(int $studentId);

    public function create(object $payload);

    public function update(object $payload, int $studentId);

    public function delete(int $studentId);
}

<?php

namespace App\Interface\Service;

interface StudentServiceInterface
{
    public function findStudents();

    public function findStudentById(int $studentId);

    public function createStudent(object $payload);

    public function updateStudent(object $payload, int $studentId);

    public function deleteStudent(int $studentId);
}

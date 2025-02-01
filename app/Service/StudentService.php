<?php

namespace App\Service;

use App\Http\Resources\StudentResource;
use App\Interface\Repository\StudentRepositoryInterface;
use App\Interface\Service\StudentServiceInterface;

class StudentService implements StudentServiceInterface
{
    private $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function findStudents()
    {
        $students = $this->studentRepository->findMany();

        return StudentResource::collection($students);
    }

    public function findStudentById(int $studentId)
    {
        $student = $this->studentRepository->findOneById($studentId);

        return new StudentResource($student);
    }

    public function createStudent(object $payload)
    {
        $student = $this->studentRepository->create($payload);

        return new StudentResource($student);
    }

    public function updateStudent(object $payload, int $studentId)
    {
        $student = $this->studentRepository->update($payload, $studentId);

        return new StudentResource($student);
    }

    public function deleteStudent(int $studentId)
    {
        return $this->studentRepository->delete($studentId);
    }
}

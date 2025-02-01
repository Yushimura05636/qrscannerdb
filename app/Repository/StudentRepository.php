<?php

namespace App\Repository;

use App\Interface\Repository\StudentRepositoryInterface;
use App\Models\Student;
use Illuminate\Http\Response;

class StudentRepository implements StudentRepositoryInterface
{
    public function findMany()
    {
        return Student::paginate(10);
    }

    public function findOneById(int $studentId)
    {
        return Student::findOrFail($studentId);
    }

    public function create(object $payload)
    {
        $student = new Student();
        $student->firstname = $payload->firstname;
        $student->lastname = $payload->lastname;
        $student->course = $payload->course;
        $student->birthday = $payload->birthday;
        $student->age = $payload->age;
        $student->allowance = $payload->allowance;
        $student->save();

        return $student->fresh();
    }

    public function update(object $payload, int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->firstname = $payload->firstname;
        $student->lastname = $payload->lastname;
        $student->course = $payload->course;
        $student->birthday = $payload->birthday;
        $student->age = $payload->age;
        $student->allowance = $payload->allowance;
        $student->save();

        return $student->fresh();
    }

    public function delete(int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->delete();

        return response()->json([
            'message' => 'Success'
        ], Response::HTTP_OK);
    }
}

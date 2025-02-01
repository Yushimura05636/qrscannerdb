<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Interface\Service\StudentServiceInterface;

class StudentController extends Controller
{
    private $studentService;

    public function __construct(StudentServiceInterface $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        return $this->studentService->findStudents();
    }

    public function store(StudentStoreRequest $request)
    {
        return $this->studentService->createStudent($request);
    }

    public function show(int $studentId)
    {
        return $this->studentService->findStudentById($studentId);
    }

    public function update(StudentUpdateRequest $request, int $studentId)
    {
        return $this->studentService->updateStudent($request, $studentId);
    }

    public function destroy(int $studentId)
    {
        return $this->studentService->deleteStudent($studentId);
    }
}

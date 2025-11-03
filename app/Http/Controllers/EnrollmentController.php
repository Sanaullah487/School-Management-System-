<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::all();
        return view('enrollments.index')->with('enrollments', $enrollments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $batches = Batches::pluck('name', 'id');
         $students = Student::pluck('name', 'id');
         return view('enrollments.create', compact('batches', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'enroll_no' => 'required|string',
        'batch_id' => 'required|integer|exists:batches,id',
        'student_id' => 'required|integer|exists:students,id',
        'join_date' => 'required|date',
        'fee' => 'required|numeric',
    ]);

    Enrollment::create($request->all());
    return redirect('enrollments')->with('flash_message', 'Enrollment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enrollments = Enrollment::find($id);
        return view('enrollments.show')->with('enrollments', $enrollments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $enrollments = Enrollment::findOrFail($id);
       $batches = Batches::pluck('name', 'id');
       $students = Student::pluck('name', 'id');
       return view('enrollments.edit', compact('enrollments', 'batches', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'enroll_no' => 'required|string',
        'batch_id' => 'required|integer|exists:batches,id',
        'student_id' => 'required|integer|exists:students,id',
        'join_date' => 'required|date',
        'fee' => 'required|numeric',
    ]);

    $enrollment = Enrollment::findOrFail($id);
    $enrollment->update($request->all());

    return redirect('enrollments')->with('flash_message', 'Enrollment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Enrollment::destroy($id);
       return redirect('enrollments')->with('flash_message', 'Enrollment Deleted successfully');
    }
}

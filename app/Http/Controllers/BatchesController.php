<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\Course;
use Illuminate\Http\Request;

class BatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batches::all();
        return view('batches.index')->with('batches', $batches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::pluck('name','id');
        return view('batches.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Batches::create($input);
        return redirect('batches')->with('flash_message', 'batche added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $batches = Batches::find($id);
        return view('batches.show')->with('batches', $batches);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $batches = Batches::find($id);
        return view('batches.edit')->with('batches', $batches);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $batches = Batches::find($id);
        $input = $request->all();
        $batches->update($input);
        return redirect('batches')->with('flash_message',  'Batches updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Batches::destroy($id);
        return redirect('batches')->with('flash_message',  'Batches Deleted');
    }
}

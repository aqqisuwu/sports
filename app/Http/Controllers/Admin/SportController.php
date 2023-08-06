<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SportStoreRequest;
use App\Models\Sport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports = Sport::all();
        return view('admin.sports.index', compact('sports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sports.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SportStoreRequest $request)
    {
        $image = $request->file('image')->store('public/sports');

        $sport = Sport::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);

        if($request->has('categories')){
            $sport->categories()->attach($request->categories);
        }

        return to_route('admin.sports.index')->with('success','Sport created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sport $sport)
    {
        $categories = Category::all();
        return view('admin.sports.edit', compact('sport','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sport $sport)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $image = $sport->image;
        if($request->hasFile('image')){
            Storage::delete($sport->image);
            $image = $request->file('image')->store('public/sports');
        }

        $sport->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ]);


        if($request->has('categories')){
            $sport->categories()->sync($request->categories);
        }

        return to_route('admin.sports.index')->with('success','Sport updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $sport)
    {
        Storage::delete($sport->image);
        $sport->categories()->detach();
        $sport->delete();
        
        return to_route('admin.sports.index')->with('danger','Sport deleted successfully.');
    }
}

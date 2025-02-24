<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function index(): View
    {
        // $input = Storage::disk('public')->get('resources.json');
        // $object = json_decode($input, true);

        // foreach ($object as $key => $value){
        //     print_r($value);
        //     DB::table('resources')->insert($value);
        // }

        // foreach ($object as $key => $value){
        //     print_r($value);
        //     echo '<br/>';
        // }
        
        return view('resources.index', [
            'resources' => Resource::get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tier' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $imageName = $request->name.'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $resource = new Resource();
        $resource->name = $request->name;
        $resource->tier = $request->tier;
        $resource->image = 'images/'.$imageName;
        $resource->save();
        return redirect()->route('admin.index')->with('success', 'Resource created successfully.');
    }

    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource): View
    {
        Gate::authorize('update', $resource);

        return view('resources.edit', [
            'resource' => $resource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource): RedirectResponse
    {
        Gate::authorize('update', $resource);

        $validated = $request->validate([
            'name' => 'required|string',
            'tier' => 'required|string',
            'image' => 'required|string',
        ]);

        $resource->update($validated);
 
        return redirect(route('resources.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource): RedirectResponse
    {
        Gate::authorize('delete', $resource);

        $resource->delete();

        return redirect(route('resources.index'));
    }
}
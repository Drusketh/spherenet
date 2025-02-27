<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FactoryController extends Controller
{
    public function index(): View
    {   
        $factories = Factory::get();

        return view('factories.index', [
            'factories' => $factories,
        ]);
    }

    public function jadd(Request $request)
    {
        $request->validate([
            'json' => 'required',
        ]);

        $input = $request->json;
        $object = json_decode($input, true);

        foreach ($object as $key => $value){
            DB::table('factories')->insert($value);
        }
        
        return redirect()->route('admin.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tier' => 'required',
            'land' => 'required',
            'c1' => 'required',
            'i1' => 'required',
            'o1' => 'required',
            'rc1' => 'required',
            'ri1' => 'required',
            'ro1' => 'required',
        ]);

        $land = $request->land . ":" . $request->landc;

        $cost2 = ($request->c2 && $request->rc2 !== '') ? (',' . $request->rc2 . ':' . $request->c2) : '';
        $cost3 = ($request->c3 && $request->rc3 !== '') ? (',' . $request->rc3 . ':' . $request->c3) : '';
        $cost4 = ($request->c4 && $request->rc4 !== '') ? (',' . $request->rc4 . ':' . $request->c4) : '';

        $cost = $request->rc1 . ':' . $request->c1 . $cost2 . $cost3 . $cost4;
        
        $input2 = ($request->i2 && $request->ri2 !== '') ? (',' . $request->ri2 . ':' . $request->i2) : '';
        $input3 = ($request->i3 && $request->ri3 !== '') ? (',' . $request->ri3 . ':' . $request->i3) : '';
        $input4 = ($request->i4 && $request->ri4 !== '') ? (',' . $request->ri4 . ':' . $request->i4) : '';

        $input = $request->ri1 . ':' . $request->i1 . $input2 . $input3 . $input4;


        $output2 = ($request->o2 && $request->ro2 !== '') ? (',' . $request->ro2 . ':' . $request->o2) : '';

        $output = $request->ro1 . ':' . $request->o1 . $output2;
        

        $factory = new Factory();
        $factory->name = $request->name;
        $factory->tier = $request->tier;
        $factory->land = $land;
        $factory->cost = $cost;
        $factory->input = $input;
        $factory->output = $output;
        $factory->save();

        $req = DB::table('users')->get();
        $users = json_decode($req, true);

        foreach ($users as $k => $v) {
            $facs = str_replace("]", "", $v["factories"]);
            $facs .= "," . "\"$factory->name\"" . ":\"0\"]";
            
            DB::table('users')->where('id', $v["id"])->update(['factories' => $facs]);
        }
        
        return redirect()->route('admin.index')->with('success', 'Factory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factory $factory)
    {
        // $input = Storage::disk('public')->get('factoriy.json');
        // $object = json_decode($input, true);
        // $put = json_encode($object, JSON_PRETTY_PRINT);
        
        // print_r($object);
        // echo '<br/>';

        // DB::table('users')->where('id',Auth::user()->id)->update(['factories' => $object]);
    
        // return redirect()->route('dashboard.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factory $factory): View
    {
        Gate::authorize('update', $factory);

        return view('factories.edit', [
            'factories' => $factory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factory $factory): RedirectResponse
    {
        Gate::authorize('update', $factory);

        $validated = $request->validate([
            'name' => 'required|string',
            'tier' => 'required',
            'cost' => 'required',
            'input' => 'required',
            'output' => 'required',
        ]);

        $factory->update($validated);
 
        return redirect(route('factories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factory $factory): RedirectResponse
    {
        Gate::authorize('delete', $factory);

        $factory->delete();

        return redirect(route('factories.index'));
    }
}

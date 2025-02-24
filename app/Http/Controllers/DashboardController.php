<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\Models\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = json_decode(json_encode(DB::table('users')->where('id', Auth::id())->get(), true), true)[0];

        return view('dashboard.index', [
            'factories' => Factory::get(),
            'ufac' => array($data["factories"]),
            'pop' => $data["population"],
            'con' => $data["continent"],
        ]);
    }

    Public function store(Request $request)
    {
        if(!$request->counts) {
            return Redirect::back()->with('message', "request is empty");
        } else {
            $object = json_decode($request->counts, true);
            DB::table('users')->where('id', Auth::id())->update(['factories' => $object]);

            return Redirect::back()->with('message', $request->counts);
        }

        return redirect()->route('dashboard.index')->with('success', 'updated');
    }
}

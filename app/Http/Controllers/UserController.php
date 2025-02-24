<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function pop(Request $request)
    {
        $request->validate([
            'pop' => 'required',
        ]);

        $pop = $request->pop;
        $message = "Population sucessfully updated to: ". $pop. ".";

        DB::table('users')->where('id', Auth::user()->id)->update(['population' => $pop]);
        
        return Redirect::back()->with('message', $message);
    }
}

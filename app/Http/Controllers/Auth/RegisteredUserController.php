<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $input = '"Farm": 0,"Windmill": 0,"Quarry": 0,"Sandstone Quarry": 0,"Sawmill": 0,"Jungle Sawmill": 0,"Concrete Factory": 0,"Stationery Factory": 0,"Ciderworks": 0,"Sandy Soda Factory": 0,"Fancy Uniform Factory": 0,"Beekeeper": 0,"Goat Shepherd": 0,"Clam Divers": 0,"Shrimp Trawler": 0,"Coal Power Plant": 0,"Iron Smelter": 0,"Stone Mason": 0,"Hydro Plant": 0,"Hydro Dam": 0,"Coffee Plantation": 0,"Pharmacy": 0,"Tobacco Plantation": 0,"Dairy Farm": 0,"Clothing Factory": 0,"Bass Fishery": 0,"Cod Fishery": 0,"Aluminum Plant": 0,"Electrical Engineering Supply Factory": 0,"Battery Assembler": 0,"Cotton Plantation": 0,"Oak Mill": 0,"Rubber Band Factory": 0,"Hunting Lodge": 0,"Yak Farm": 0,"Mackerel Fishery": 0,"Salmon Fishery": 0,"Gold Mine": 0,"Platinum Refinery": 0,"Silver Mine": 0,"Nuclear Power Plant": 0,"Christmas Tree Factory": 0,"Chocolate Factory": 0,"Winery": 0,"Mozzarella Factory": 0,"Ivory Arts": 0,"Hardened Fisherman": 0,"Dolphin Aquarium": 0,"Explosives Factory": 0,"Petroleum Refinery": 0,"Nuclear Reactor": 0';

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'factories' => $input,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard.index', absolute: false));
    }
}

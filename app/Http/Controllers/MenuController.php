<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function toggleMenuState(Request $request)
    {
        $newState = $request->input('menuState');
        session(['menuState' => $newState]);

        return response()->json(['status' => 'success', 'menuState' => $newState]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index() {
        $properties = Property::query()->recent()->available()->limit(4)->get();

        return view('home.index', [
            'properties' => $properties
        ]);
    }
}

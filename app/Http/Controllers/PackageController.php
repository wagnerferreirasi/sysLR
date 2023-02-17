<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function getAll()
    {
        $packages = Package::all();

        return response()->json([
            'success' => true,
            'data' =>$packages
        ], 201);
    }
}

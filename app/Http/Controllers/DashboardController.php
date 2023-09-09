<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Photo;

class DashboardController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(15);
        return view('dashboard', ['photos' => $photos]);
    }
    
}

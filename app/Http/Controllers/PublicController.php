<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.dashboard');
    }
}

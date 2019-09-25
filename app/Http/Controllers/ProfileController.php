<?php

namespace App\Http\Controllers;

use App\Profile;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Index');
    }
}

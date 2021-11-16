<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Models\Category;



class WelcomController extends Controller
{
    public function index()
    {
        $users_count = User::whereRole('user')->count();
        $categories_count = Category::count();
        $movies_count = Movie::where('percent', 100)->count();

        return view('dashboard.welcom', compact('users_count', 'categories_count', 'movies_count'));

    }// end of index

}//end of controller

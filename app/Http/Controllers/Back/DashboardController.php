<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("back.dashboard.index", [
            "page" => "dashboard",
            "numberOfUsers" => User::count(),
            "numberOfArticles" => Article::count(),
        ]);
    }
}

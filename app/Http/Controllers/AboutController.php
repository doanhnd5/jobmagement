<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        // Xử lý logic và trả về view của trang
        return view('layout.pages.about');
    }
}

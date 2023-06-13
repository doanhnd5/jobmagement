<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        // Xử lý logic và trả về view của trang
        return view('layout.pages.contact');
    }
}

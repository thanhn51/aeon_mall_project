<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $this->isPermission('admin');
        return view('admin.layouts.master')->with('message','Chào sếp đến với trang quản trị');
    }
}

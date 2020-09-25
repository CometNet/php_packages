<?php


namespace Huixing\Admin\Controllers;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index(){
        return view('admin::content');
    }
}
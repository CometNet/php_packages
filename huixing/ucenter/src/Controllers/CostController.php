<?php

namespace Huixing\UCenter\Controllers;

use Huixing\UCenter\Models\Cost;
use Huixing\UCenter\Facades\UCenter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 充值消费控制器
 * Class CostController
 * @package Huixing\UCenter\Controllers
 */
class CostController extends AuthController
{

    public function index(){
        return view("ucenter::costs.detailed");
    }

    public function create(){
        return view("ucenter::costs.invest");
    }

    public function store(Request $request){
        Cost::create($request->all());
        admin_toastr('充值成功,等待工作人员审核');
        return redirect('cost/detailed');
    }

}
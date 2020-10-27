<?php

namespace Huixing\UCenter\Controllers;

use Huixing\UCenter\Facades\UCenter;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 个人账户相关控制器
 * Class CostController
 * @package Huixing\UCenter\Controllers
 */
class AccountController extends AuthController
{

    public function index(){
        return view("ucenter::accounts.index");
    }

    public function update(){
        $data = Request::all();
        $field = $data['field'];
        $value = $data['value'];
        switch ($field){
            case 'password':
                $value = bcrypt($value);
                break;
        }
        $user = UCenter::user();
        $user->$field = $value;
        $user->save();
        return json_encode(['code' => 0, 'data' => '修改成功']);
    }
}
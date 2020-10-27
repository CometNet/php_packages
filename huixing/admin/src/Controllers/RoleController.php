<?php


namespace Huixing\Admin\Controllers;

use Huixing\Admin\Facades\Admin;
use Huixing\Admin\Models\Role;
use Huixing\Admin\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $table_columns = [
        [
            'field' => 'id',
            'title' => 'Id'
        ],
        [
            'field' => 'slug',
            'title' => '标识'
        ],
        [
            'field' => 'name',
            'title' => '名称'
        ],
        [
            'field' => 'permissions',
            'title' => '权限'
        ],
        [
            'field' => 'created_at',
            'title' => '创建时间'
        ],
        [
            'field' => 'updated_at',
            'title' => '更新时间'
        ],
        [
            'field' => 'operate',
            'title' => '操作',
            "align" => 'center',
            'events' => 'operateEvents',
            'formatter' => 'operateFormatter'
        ]
    ];

    public function index(){

        return view('admin::roles.list',['table_columns' => $this->table_columns]);
    }

    public function getlist(Request $request){
        $model = new Role();
        echo json_encode(['rows' => $model->get(), 'total' => $model->count()]);
    }

    public function create(){
        return view('admin::roles.create',[
            'permissions' => Permission::all()
        ]);
    }

    public function store(Request $request){
        Role::create($request->all());
    }

    public function show(Request $request){

    }

    public function edit(Request $request, $id){
        return view('admin::roles.edit',[
            'permissions' => Permission::all(),
            'role' => Role::find($id)
        ]);
    }

    public function update(Request $request){

    }

    public function destroy(Request $request){

    }
}
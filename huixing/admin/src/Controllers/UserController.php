<?php


namespace Huixing\Admin\Controllers;

use Huixing\Admin\Models\Administrator;
use Huixing\Admin\Models\Permission;
use Huixing\Admin\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

    protected $table_columns = [
        [
            'field' => 'id',
            'title' => 'Id'
        ],
        [
            'field' => 'username',
            'title' => '账号'
        ],
        [
            'field' => 'name',
            'title' => '名称'
        ],
        [
            'field' => 'avatar',
            'title' => '头像'
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

    public function getlist(Request $request){
        $model = new Administrator();
        echo json_encode(['rows' => $model->get(), 'total' => $model->count()]);
    }

    public function index(){
        return view('admin::users.list',['table_columns' => $this->table_columns]);
    }
    public function create(){
        return view('admin::users.create',[
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }
    public function store(Request $request){
        Permission::create($request->all());
    }

    public function show(Request $request){

    }

    public function edit(Request $request, $id){
        return view('admin::users.edit',[
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'user' => Administrator::find($id)
        ]);
    }

    public function update(Request $request){

    }

    public function destroy(Request $request){

    }
}
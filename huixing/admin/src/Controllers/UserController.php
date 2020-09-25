<?php


namespace Huixing\Admin\Controllers;

use Huixing\Admin\Models\Permission;
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
            'field' => 'slug',
            'title' => '标识'
        ],
        [
            'field' => 'name',
            'title' => '名称'
        ],
        [
            'field' => 'http_path',
            'title' => '路由'
        ],
        [
            'field' => 'created_at',
            'title' => '创建时间'
        ],
        [
            'field' => 'updated_at',
            'title' => '更新时间'
        ]
    ];

    public function getlist(Request $request){
        $model = new Permission();
        echo json_encode(['rows' => $model->get(), 'total' => $model->count()]);
    }

    public function index(){
        return view('admin::permissions.list',['table_columns' => $this->table_columns]);
    }
    public function create(){
        return view('admin::permissions.create');
    }
    public function store(Request $request){
        Permission::create($request->all());
    }

    public function show(Request $request){

    }

    public function edit(Request $request){

    }

    public function update(Request $request){

    }

    public function destroy(Request $request){

    }
}
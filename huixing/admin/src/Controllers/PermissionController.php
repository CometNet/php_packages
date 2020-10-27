<?php


namespace Huixing\Admin\Controllers;

use Huixing\Admin\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
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
        $model = new Permission();
        echo json_encode(['rows' => $model->get(), 'total' => $model->count()]);die;
    }

    public function index(){
        return view('admin::permissions.list',[
            'table_columns' => $this->table_columns
            ]);
    }
    public function create(){
        return view('admin::permissions.create',[
            'http_methods' => $this->getHttpMethodsOptions()
        ]);
    }
    public function store(Request $request){
        Permission::create($request->all());
    }

    public function show(Request $request){

    }

    public function edit(Request $request, $id){
        return view('admin::permissions.edit',[
            'http_methods' => $this->getHttpMethodsOptions(),
            'permission' => Permission::find($id)
        ]);
    }

    public function update(Request $request){

    }

    public function destroy(Request $request){

    }

    /**
     * Get options of HTTP methods select field.
     *
     * @return array
     */
    protected function getHttpMethodsOptions()
    {
        $model = config('admin.database.permissions_model');

        return array_combine($model::$httpMethods, $model::$httpMethods);
    }
}
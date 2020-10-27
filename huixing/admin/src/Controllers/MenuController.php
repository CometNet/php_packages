<?php


namespace Huixing\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Huixing\Admin\Models\Menu;
use Huixing\Admin\Models\Role;
use Huixing\Admin\Models\Permission;

class MenuController extends Controller
{
    public function index(){
        return view('admin::menu',[
            'menus' => Menu::all(),
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function list(Request $request){
        $model = new Menu();
        echo json_encode(['rows' => $model->get(), 'total' => $model->count()]);
    }

    public function store(Request $request){
        if ($request->has('_order')) {
            $order = json_decode($request->get('_order'),true);
            $request->offsetUnset('_order');
            Menu::saveOrder($order);
            die("保存成功");
        }else{
            $menu = Menu::create($request->all());
            if ($request->has('roles')){
                $menu->roles()->sync($request->get('roles'));
            }
        }
        return redirect(admin_base_path('auth/menu'));
    }

    public function show(Request $request){

    }

    public function edit($id){
        return view('admin::menus.edit',[
            'menus' => Menu::all(),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'menu' => Menu::find($id)
        ]);
    }

    public function update(Request $request, $id){
        $menu = Menu::find($id);
        $menu->update($request->all());
        if ($request->has('roles')){
            $menu->roles()->sync($request->get('roles'));
        }

        return redirect(admin_base_path('auth/menu'));
    }

    public function destroy(Request $request,$id){
        $menu = Menu::find($id);
        $menu->delete();
        return redirect(admin_base_path('auth/menu'));
    }
}
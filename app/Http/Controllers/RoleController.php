<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleAddRequest;
use App\Http\Requests\RoleEditRequest;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(Request $request) {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // get search param
        $search = trim($request->get('search') ?? '');

        // retrieve roles data
        $roles = Role::orderBy('id', 'DESC')
            ->when(!empty($search), function($query) use($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->paginate(10)->onEachSide(1)
            ->appends(request()->query());

        return view('pages.roles.index')->with([
            'roles' => $roles,
            'search' => $search,
        ]);
        
    }

    public function create() {

        return view('pages.roles.create');
    }

    public function store(RoleAddRequest $request) {

    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update(RoleEditRequest $request, $id) {

    }

}

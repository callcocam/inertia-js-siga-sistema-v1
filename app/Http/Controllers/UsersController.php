<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class UsersController extends AbstractController
{

    protected $template = 'Users';
    protected $route = 'users';

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->model = get_user_model();

        return parent::index();
    }

    /**
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        $this->model = get_user_model();

        return parent::_store($request,['name','slug','email','status','description','owner']);
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->model = get_user_model();

        return parent::_update($request, $id,['name','slug','email','status','description','owner']);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->model = get_user_model();

        return parent::edit($id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->model = get_user_model();

        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $row = app($this->model)->find($id);

        if (!$row)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        if (App::environment('demo') && $row->isDemoUser()) {
            return Redirect::back()->with('error', 'Deleting the admin user is not allowed.');
        }
        return parent::destroy($id);
    }

    public function upload(Request $request)
    {
        $this->model = get_user_model();

        return parent::_upload($request, 'photo');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $this->model = get_user_model();

        return parent::restore($id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->model = get_user_model();

        return parent::show($id);
    }

    /**
     * @param $row
     * @return array
     */
    protected function transform($row)
    {

        $data = [
            'id' => $row->id,
            'name' => $row->name,
            'email' => $row->email,
            'photo' => $row->photoUrl(['w' => 40, 'h' => 40, 'fit' => 'crop']),
            'description' => $row->description,
            'status' => $row->status,
            'deleted_at' => $row->deleted_at,
        ];

        if(app('currentTenant')->database !='landlord'){
            $data['phone'] = $row->phone;
            $data['document'] = $row->document;
        }
        else{
            $data['owner'] = $row->owner;
        }

        return $data;
    }

//    public function destroy(User $user)
//    {
//        if (App::environment('demo') && $user->isDemoUser()) {
//            return Redirect::back()->with('error', 'Deleting the demo user is not allowed.');
//        }
//
//        $user->delete();
//
//        return Redirect::back()->with('success', 'User deleted.');
//    }

//    public function restore(User $user)
//    {
//        $user->restore();
//
//        return Redirect::back()->with('success', 'User restored.');
//    }
}

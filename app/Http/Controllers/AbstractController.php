<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Request as Rq;
use Inertia\Inertia;

class AbstractController extends Controller
{

    protected $results = [];
    protected $model;
    protected $template = 'Dashboard';
    protected $route;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->routeName();
        $this->results['filters'] = Rq::all('search', 'status', 'perpage', 'role', 'trashed');
        $this->results['rows'] = [];
        if ($this->model) {
            $this->results['rows'] = app($this->model)
                ->filter(Rq::only('search', 'status', 'perpage', 'role', 'trashed'))
                ->transform(function ($row) {
                    return $this->transform($row);
                });
        }

        return Inertia::render(sprintf('%s/Index', $this->template), $this->results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->routeName();

        return Inertia::render(sprintf('%s/Create', $this->template), $this->results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FormRequest $request
     * @return void
     */
    public function _store(FormRequest $request, $fillable)
    {
        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $this->routeName();

        $row = app($this->model)->create($request->only($fillable));

        if ($request->get('password')) {
            $row->update(['password' => $request->get('password')]);
        }

        return Redirect::route($this->results['edit_url'], $row->id)->with('success', 'Registro atualizado com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function _update(Request $request, $id, $fillable)
    {
        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $row = app($this->model)->find($id);

        if (!$row)
            return Redirect::back()->with('error', 'Registro não foi encontrado');

        $row->update($request->only($fillable));

        if ($request->get('password')) {
            $row->update(['password' => $request->get('password')]);
        }

        return Redirect::back()->with('success', 'Registro atualizado com sucesso.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param string $field
     * @return \Illuminate\Http\RedirectResponse
     */
    public function _upload(Request $request, $field="photo")
    {
        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $request->validate([
            $field => ['nullable', 'image'],
        ]);

        $row = app($this->model)->find($request->get('id'));

        if (!$row)
            return Redirect::back()->with('error', 'Registro não foi encontrado');

        $row->update([$field=>$request->file($field)->store($this->route)]);

        return Redirect::back()
            ->with('success', 'Upload realizado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $row = app($this->model)->withTrashed()->find($id);

        if ($row)
            return Redirect::back()->with('error', 'Registro não foi encontrado');

        $this->routeName();

        $this->results['row'] = $row;

        return Inertia::render(sprintf("%s/Show", $this->template), $this->results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $row = app($this->model)->withTrashed()->find($id);
        if (!$row)
            return Redirect::back()->with('error', 'Registro não foi encontrado');

        $this->routeName();

        $this->results['row'] = $this->transform($row);

        return Inertia::render(sprintf("%s/Edit", $this->template), $this->results);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $row = app($this->model)->find($id);
        if (!$row)
            return Redirect::back()->with('error', 'Registro não foi encontrado');

        $row->delete();

        return Redirect::back()->with('success', 'Registro excluido com sucesso.');
    }

    public function restore($id)
    {
        if (!$this->model)
            return Redirect::back()->with('error', 'Modelo não foi informado');

        $row = app($this->model)->withTrashed()->find($id);

        if (!$row)
            return Redirect::back()->with('error', 'Registro não foi encontrado');

        $row->restore();

        return Redirect::back()->with('success', 'User restored.');
    }

    protected function transform($row)
    {
        return $row->toArray();
    }

    protected function routeName()
    {
        $this->results['create_url'] = sprintf("%s.create", $this->route);
        $this->results['edit_url'] = sprintf("%s.edit", $this->route);
        $this->results['destroy_url'] = sprintf("%s.destroy", $this->route);
        $this->results['restore_url'] = sprintf("%s.restore", $this->route);
        $this->results['update_url'] = sprintf("%s.update", $this->route);
        $this->results['store_url'] = sprintf("%s.store", $this->route);
        $this->results['upload_url'] = sprintf("%s.upload", $this->route);
        $this->results['download_url'] = sprintf("%s.download", $this->route);
    }
}

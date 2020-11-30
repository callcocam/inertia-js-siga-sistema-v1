<?php

namespace App\Http\Controllers;


use App\Http\Requests\TenantRequest;
use Call\Tenant\Models\Tenant;

class TenantController extends AbstractController
{
    protected $template = "Tenant";
    protected $route = "tenants";
    protected $model = Tenant::class;

    public function store(TenantRequest $request)
    {
      return parent::_store($request);
    }

    public function update(TenantRequest $request, $id)
    {
        return parent::_update($request, $id);
    }
}

<?php

namespace App\Models;
use Call\Tenant\Models\Concerns\UsesTenantConnection;

class Account extends AbstractModel
{
    use UsesTenantConnection;
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

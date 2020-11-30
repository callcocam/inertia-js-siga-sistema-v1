<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Models;

use App\Models\Traits\SelectTraits;
use Call\Tenant\Traits\BelongsToTenants;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class AbstractModel extends Eloquent
{
    use SoftDeletes, BelongsToTenants, SelectTraits;

    protected $guarded = [];

    public $incrementing = false;

    protected $keyType = "string";

    protected $perPage = 10;

    protected $search_enabled = true;

    public function columns()
    {
       return ['name'];
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return in_array(SoftDeletes::class, class_uses($this))
            ? $this->where($this->getRouteKeyName(), $value)->withTrashed()->first()
            : parent::resolveRouteBinding($value);
    }


    public function isTenant(){

        if ( config( "database.connections.{$this->landlordDatabaseConnectionName()}.database" ) === "landlord") {
            return false;
        }

        return true;
    }

    public function isUser(){

        return false;
    }

}

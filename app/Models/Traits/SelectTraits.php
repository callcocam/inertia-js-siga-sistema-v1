<?php


namespace App\Models\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait SelectTraits
{
    /**
     * @var Request
     */
    protected $updatesQueryString;
    protected $paginationEnabled = false;
    protected $builder;

    abstract public function columns();


    /**
     * @param Builder $builder
     * @param array $updatesQueryString
     * @return mixed
     */
    public function scopeFilter(Builder $builder, array $updatesQueryString)
    {

        $this->updatesQueryString = $updatesQueryString;

        $builder->when($this->searchEnabled() && $this->columns(),function (Builder $builder) {

                foreach ($this->columns() as $column) {
                    if (is_string($column) && $column) {
                        $builder->orWhere(sprintf('%s.%s', $this->getTable(), $column), 'like', '%' . $this->getUpdatesQueryString('search') . '%');
                    }
                }
        });

        $builder->when( $this->getUpdatesQueryString('trashed') ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });

        $this->getBuilder($builder,$updatesQueryString);

        $column = $this->getUpdatesQueryString('column', 'created_at');

        $direction = $this->getUpdatesQueryString('direction', 'desc');

        if ($this->paginationEnabled):
            $results = $builder->orderBy($column, $direction)->paginate($this->getUpdatesQueryString('perPage', 12));
        else:
            $results = $builder->orderBy($column, $direction)->get();
        endif;

        return $results;
    }


    protected function searchEnabled()
    {
        if(empty(trim($this->getUpdatesQueryString('search')))){
            return false;
        }
        return $this->search_enabled;
    }

    protected function getUpdatesQueryString($key, $default = null)
    {

        if (Arr::has($this->updatesQueryString,$key))
            return Arr::get($this->updatesQueryString,$key, $default);

        return $default;
    }

    protected function getBuilder(&$builder, array $filters)
    {
        return $builder;
    }
}

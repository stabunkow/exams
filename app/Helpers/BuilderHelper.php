<?php
namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

trait BuilderHelper
{
    public function filterQuery(Builder $builder, array $filters)
    {
        foreach ($filters as $key => $value) {
            $builder = $builder->where($key, $value);
        }

        return $builder;
    }

    public function searchQuery(Builder $builder, array $keywords, $q)
    {
        foreach ($keywords as $key => $value) {
            if (! $key) {
                $builder = $builder->where($value, 'like', "%$q%");
            } else {
                $builder = $builder->orWhere($value, 'like', "%$q%");
            }
        }

        return $builder;
    }
}
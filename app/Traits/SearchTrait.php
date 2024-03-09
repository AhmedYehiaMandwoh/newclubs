<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;

/**
 * @property-read HigherOrderBuilderProxy $search
 * @mixin \Illuminate\Database\Query\Builder
 */
trait SearchTrait
{
    /*
    * search([
    *      'name','email',
    *      'description'=>[
    *          is_trans=>true,
    *          all_lang=>true,
    *          is_relation=>true,
    *      ],
    * ])
    * */
    /**
     * @param $query
     * @param array $columns
     * @param null $search_key
     * @return $this
     */
    public function scopeSearch($query,array $columns = [], $search_key = null)
    {
        return $this->elSearch($query, $search_key, $columns);
    }

    private function elSearch($query, $search_key = null, array $columns = [])
    {
        $search_key = trim($search_key ?? request()->search);
        //check if search key exist
        if ($search_key === '')
            return $query;

        $model_columns = $this->searchColumns ?? [];
        $new_column = [];
        foreach ($columns as $key => $column) {
            is_int($key) ? $new_column[$column] = [] : $new_column[$key] = $column;
        }
        $columns = array_merge($model_columns, $new_column);
        /* if ($trans_column) {
             foreach ($trans_column as $item) {
                 $columns[$item] = ['is_trans' => true];
             }
         }*/
        //check if search key exist
        if (count($columns) === 0)
            return $query;

        $query->where(function ($q) use ($search_key, $columns) {
            //foreach search column
            foreach ($columns as $key => $option) {
                $key = is_int($key) ? $option : $key;
                $search_key = "%$search_key%";

                if (data_get($option, 'is_relation')) {
                    $relation = explode('.', $key);
                    if (count($relation) === 2)
                        $q->orWhereHas($relation[0], fn($q) => $q->where($relation[1], 'like', $search_key));
                } else if (data_get($option, 'is_trans')) {
                    if (data_get($option, 'all_lang')) {
                        $q->orWhere($key . '->ar', "like", $search_key)->orWhere($key . '->en', "like", $search_key);
                    } else {
                        $q->orWhere($key . '->' . \App::getLocale(), "like", $search_key);
                    }
                } else {
                    $q->orWhere($key, "like", $search_key);
                }
            }
        });

        return $query;
    }
}


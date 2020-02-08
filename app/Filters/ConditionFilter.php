<?php

namespace App\Filters;

class ConditionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('quality', $value);
    }
}

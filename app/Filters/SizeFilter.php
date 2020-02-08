<?php

namespace App\Filters;

class SizeFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('size', $value);
    }
}

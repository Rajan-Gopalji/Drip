<?php

namespace App\Filters;

class ColourFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('colour', $value);
    }
}

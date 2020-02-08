<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Cassandra\Type;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    protected $filters = [
        'category' => TypeFilter::class,
        'size' => SizeFilter::class,
        'quality' => ConditionFilter::class
    ];
}

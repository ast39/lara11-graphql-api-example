<?php

namespace App\Models\Scopes;

use App\Models\Scopes\Filter\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;


class CategoryScope extends AbstractFilter {
    public const TITLE = 'title';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::TITLE => [$this, 'title'],
        ];
    }

    public function title(Builder $builder, $value): void
    {
        $builder->where('title', 'like', '%'.$value.'%');
    }

}

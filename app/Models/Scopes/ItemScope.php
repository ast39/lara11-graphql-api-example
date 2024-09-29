<?php

namespace App\Models\Scopes;

use App\Models\Scopes\Filter\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;


class ItemScope extends AbstractFilter {

    public const Q = 'q';
    public const CATEGORY_ID = 'category_id';

    /**
     * @return array[]
     */
    protected function getCallbacks(): array
    {
        return [

            self::Q => [$this, 'q'],
            self::CATEGORY_ID => [$this, 'category'],
        ];
    }

    public function q(Builder $builder, $value): void
    {
        $builder->where('title', 'like', '%'.$value.'%');
    }

    public function category(Builder $builder, $value): void
    {
        $builder->where('category_id', $value);
    }

}

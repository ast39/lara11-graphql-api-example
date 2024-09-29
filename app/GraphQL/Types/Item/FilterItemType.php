<?php

namespace App\GraphQL\Types\Item;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class FilterItemType extends InputType {

    protected $attributes = [
        'name' => 'FilterItem',
        'description' => 'Параметры фильтрации товаров',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'title' => [
                'type' => Type::string(),
                'description' => 'Название категории',
            ],
            'category_id' => [
                'type' => Type::int(),
                'description' => 'ID категории',
            ],
        ];
    }
}

<?php

namespace App\GraphQL\Types\Category;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class FilterCategoryType extends InputType {

    protected $attributes = [
        'name' => 'FilterCategory',
        'description' => 'Параметры фильтрации категорий',
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
        ];
    }
}

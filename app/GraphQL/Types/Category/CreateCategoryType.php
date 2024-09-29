<?php

namespace App\GraphQL\Types\Category;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CreateCategoryType extends InputType {

    protected $attributes = [
        'name' => 'CreateCategory',
        'description' => 'Данные для создания категории',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Название категории',
            ],
        ];
    }
}

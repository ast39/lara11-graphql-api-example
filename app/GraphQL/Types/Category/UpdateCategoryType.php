<?php

namespace App\GraphQL\Types\Category;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UpdateCategoryType extends InputType {

    protected $attributes = [
        'name' => 'UpdateCategory',
        'description' => 'Данные для обновления категории',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID категории',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Название категории',
            ],
        ];
    }
}

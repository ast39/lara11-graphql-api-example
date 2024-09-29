<?php

namespace App\GraphQL\Types\Category;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class DeleteCategoryType extends InputType {

    protected $attributes = [
        'name' => 'DeleteCategory',
        'description' => 'Данные для удаления категории',
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
        ];
    }
}

<?php

namespace App\GraphQL\Types\Item;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class CreateItemType extends InputType {

    protected $attributes = [
        'name' => 'CreateItem',
        'description' => 'Данные для создания товара',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Название товара',
            ],
            'category_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID категории',
            ],
        ];
    }
}

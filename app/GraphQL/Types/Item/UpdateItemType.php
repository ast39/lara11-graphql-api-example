<?php

namespace App\GraphQL\Types\Item;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UpdateItemType extends InputType {

    protected $attributes = [
        'name' => 'UpdateItem',
        'description' => 'Данные для обновления товара',
    ];

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID товара',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Название товара',
            ],
            'category_id' => [
                'type' => Type::int(),
                'description' => 'ID категории',
            ],
        ];
    }
}

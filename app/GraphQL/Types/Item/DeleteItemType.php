<?php

namespace App\GraphQL\Types\Item;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class DeleteItemType extends InputType {

    protected $attributes = [
        'name' => 'DeleteItem',
        'description' => 'Данные для удаления товара',
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
        ];
    }
}

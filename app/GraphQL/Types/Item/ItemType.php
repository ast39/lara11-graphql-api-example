<?php

namespace App\GraphQL\Types\Item;

use App\Models\Item;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ItemType extends GraphQLType {

    protected $attributes = [
        'name' => 'Item',
        'description' => 'Объект товара',
        'model' => Item::class,
    ];

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
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Время создания товара',
                'resolve' => function($model) {
                    return $model->created_at;
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Время обновления товара',
                'resolve' => function($model) {
                    return $model->created_at;
                }
            ],
        ];
    }
}

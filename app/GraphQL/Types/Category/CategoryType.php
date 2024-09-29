<?php

namespace App\GraphQL\Types\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType {

    protected $attributes = [
        'name' => 'Category',
        'description' => 'Объект категории',
        'model' => Category::class,
    ];

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
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Время создания категории',
                'resolve' => function($model) {
                    return $model->created_at;
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Время обновления категории',
                'resolve' => function($model) {
                    return $model->created_at;
                }
            ],
        ];
    }
}

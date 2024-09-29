<?php

namespace App\GraphQL\Mutations\Category;

use App\Http\Exceptions\CategoryException;
use App\Http\Services\CategoryService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class DeleteCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'createCategory',
        'description' => 'Удаление категории'
    ];

    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::boolean();
    }

    /**
     * @return array[]
     */
    public function args(): array
    {
        return [
            'data' => [
                'name' => 'data',
                'type' => GraphQL::type('DeleteCategory'),
                'description' => 'Удаляемая категория',
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return bool
     * @throws CategoryException
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): bool
    {
        $dataArgs = $args['data'] ?? [];
        $this->categoryService->destroy($dataArgs['id']);

        return true;
    }
}

<?php

namespace App\GraphQL\Mutations\Category;

use App\Http\Dto\Category\UpdateCategoryDto;
use App\Http\Exceptions\CategoryException;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class UpdateCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'createCategory',
        'description' => 'Обновление категории'
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
        return GraphQL::type('Category');
    }

    /**
     * @return array[]
     */
    public function args(): array
    {
        return [
            'data' => [
                'name' => 'data',
                'type' => GraphQL::type('UpdateCategory'),
                'description' => 'Обновленные данные категории',
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Category
     * @throws CategoryException
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Category
    {
        $dataArgs = $args['data'] ?? [];
        $dto = new UpdateCategoryDto($dataArgs);

        return $this->categoryService->update($dto);
    }
}

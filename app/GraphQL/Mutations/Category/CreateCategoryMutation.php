<?php

namespace App\GraphQL\Mutations\Category;

use App\Http\Dto\Category\CreateCategoryDto;
use App\Http\Exceptions\CategoryException;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class CreateCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'createCategory',
        'description' => 'Создание категории'
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
                'type' => GraphQL::type('CreateCategory'),
                'description' => 'Данные новой категории',
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
        $dto = new CreateCategoryDto($dataArgs);

        return $this->categoryService->store($dto);
    }
}

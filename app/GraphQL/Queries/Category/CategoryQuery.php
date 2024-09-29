<?php

namespace App\GraphQL\Queries\Category;

use App\Http\Dto\Category\FilterCategoryDto;
use App\Http\Services\CategoryService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoryQuery extends Query {

    protected $attributes = [
        'name' => 'categoryList',
        'description' => 'Список категорий',
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
        return Type::listOf(GraphQL::type('Category'));
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'filter' => [
                'name' => 'filter',
                'type' => GraphQL::type('FilterCategory'),
                'description' => 'Фильтрация категорий',
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Collection
     * @throws BindingResolutionException
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        $filterArgs = $args['filter'] ?? [];
        $dto = new FilterCategoryDto($filterArgs);

        return $this->categoryService->index($dto);
    }
}

<?php

namespace App\GraphQL\Queries\Item;

use App\Http\Dto\Item\FilterItemDto;
use App\Http\Services\ItemService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemQuery extends Query {

    protected $attributes = [
        'name' => 'itemList',
        'description' => 'Список товаров',
    ];

    protected ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Item'));
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'filter' => [
                'name' => 'filter',
                'type' => GraphQL::type('FilterItem'),
                'description' => 'Фильтрация товаров',
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
        $dto = new FilterItemDto($filterArgs);

        return $this->itemService->index($dto);
    }
}

<?php

namespace App\GraphQL\Queries\Item;

use App\Http\Dto\Item\FilterItemDto;
use App\Http\Exceptions\ItemException;
use App\Http\Services\ItemService;
use App\Models\Item;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemByIdQuery extends Query {

    protected $attributes = [
        'name' => 'itemById',
        'description' => 'Товар по ID',
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
        return GraphQL::type('Item');
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID товара',
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Item
     * @throws ItemException
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Item
    {
        return $this->itemService->show($args['id']);
    }
}

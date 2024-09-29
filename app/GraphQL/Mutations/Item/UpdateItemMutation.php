<?php

namespace App\GraphQL\Mutations\Item;

use App\Http\Dto\Item\UpdateItemDto;
use App\Http\Exceptions\ItemException;
use App\Http\Services\ItemService;
use App\Models\Item;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class UpdateItemMutation extends Mutation {

    protected $attributes = [
        'name' => 'createItem',
        'description' => 'Обновление товара'
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
     * @return array[]
     */
    public function args(): array
    {
        return [
            'data' => [
                'name' => 'data',
                'type' => GraphQL::type('UpdateItem'),
                'description' => 'Обновленные данные товара',
            ]
        ];
    }

    /**
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Item
     * @throws ItemException
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Item
    {
        $dataArgs = $args['data'] ?? [];
        $dto = new UpdateItemDto($dataArgs);

        return $this->itemService->update($dto);
    }
}

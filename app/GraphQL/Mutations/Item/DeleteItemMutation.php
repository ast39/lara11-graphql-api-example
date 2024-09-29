<?php

namespace App\GraphQL\Mutations\Item;

use App\Http\Exceptions\ItemException;
use App\Http\Services\ItemService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class DeleteItemMutation extends Mutation {

    protected $attributes = [
        'name' => 'createItem',
        'description' => 'Удаление товара'
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
                'type' => GraphQL::type('DeleteItem'),
                'description' => 'Удаляемый товар',
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
     * @throws ItemException
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): bool
    {
        $dataArgs = $args['data'] ?? [];
        $this->itemService->destroy($dataArgs['id']);

        return true;
    }
}

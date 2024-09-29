<?php

declare(strict_types = 1);

use App\GraphQL\Mutations\Category\CreateCategoryMutation;
use App\GraphQL\Mutations\Category\DeleteCategoryMutation;
use App\GraphQL\Mutations\Category\UpdateCategoryMutation;
use App\GraphQL\Mutations\Item\CreateItemMutation;
use App\GraphQL\Mutations\Item\DeleteItemMutation;
use App\GraphQL\Mutations\Item\UpdateItemMutation;
use App\GraphQL\Queries\Category\CategoryByIdQuery;
use App\GraphQL\Queries\Category\CategoryQuery;
use App\GraphQL\Queries\Item\ItemByIdQuery;
use App\GraphQL\Queries\Item\ItemQuery;
use App\GraphQL\Types\Category\CategoryType;
use App\GraphQL\Types\Category\CreateCategoryType;
use App\GraphQL\Types\Category\DeleteCategoryType;
use App\GraphQL\Types\Category\FilterCategoryType;
use App\GraphQL\Types\Category\UpdateCategoryType;
use App\GraphQL\Types\Item\CreateItemType;
use App\GraphQL\Types\Item\DeleteItemType;
use App\GraphQL\Types\Item\FilterItemType;
use App\GraphQL\Types\Item\ItemType;
use App\GraphQL\Types\Item\UpdateItemType;

return [
    'route' => [

        'prefix' => 'graphql',

        // The controller/method to use in GraphQL request.
        // Also supported array syntax: `[\Rebing\GraphQL\GraphQLController::class, 'query']`
        'controller' => Rebing\GraphQL\GraphQLController::class . '@query',

        // Any middleware for the graphql route group
        // This middleware will apply to all schemas
        'middleware' => [],

        // Additional route group attributes
        //
        // Example:
        //
        // 'group_attributes' => ['guard' => 'api']
        //
        'group_attributes' => [],
    ],

    'default_schema' => 'default',

    'batching' => [
        'enable' => true,
    ],

    'schemas' => [
        'default' => [
            'query' => [
                'categoryById' => CategoryByIdQuery::class,
                'categoryList' => CategoryQuery::class,

                'itemById' => ItemByIdQuery::class,
                'itemList' => ItemQuery::class,
            ],
            'mutation' => [
                'createCategory' => CreateCategoryMutation::class,
                'updateCategory' => UpdateCategoryMutation::class,
                'deleteCategory' => DeleteCategoryMutation::class,

                'createItem' => CreateItemMutation::class,
                'updateItem' => UpdateItemMutation::class,
                'deleteItem' => DeleteItemMutation::class,
            ],
            'types' => [
                CategoryType::class,
                FilterCategoryType::class,
                CreateCategoryType::class,
                UpdateCategoryType::class,
                DeleteCategoryType::class,

                ItemType::class,
                FilterItemType::class,
                CreateItemType::class,
                UpdateItemType::class,
                DeleteItemType::class,
            ],
            'middleware' => null,
            'method' => ['GET', 'POST'],
            'execution_middleware' => null,
        ],
    ],

    'types' => [
        //
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => [Rebing\GraphQL\GraphQL::class, 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => [Rebing\GraphQL\GraphQL::class, 'handleErrors'],

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://webonyx.github.io/graphql-php/security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => Rebing\GraphQL\Support\PaginationType::class,

    /*
     * You can define your own simple pagination type.
     * Reference \Rebing\GraphQL\Support\SimplePaginationType::class
     */
    'simple_pagination_type' => Rebing\GraphQL\Support\SimplePaginationType::class,

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,

    /*
     * Automatic Persisted Queries (APQ)
     * See https://www.apollographql.com/docs/apollo-server/performance/apq/
     *
     * Note 1: this requires the `AutomaticPersistedQueriesMiddleware` being enabled
     *
     * Note 2: even if APQ is disabled per configuration and, according to the "APQ specs" (see above),
     *         to return a correct response in case it's not enabled, the middleware needs to be active.
     *         Of course if you know you do not have a need for APQ, feel free to remove the middleware completely.
     */
    'apq' => [
        // Enable/Disable APQ - See https://www.apollographql.com/docs/apollo-server/performance/apq/#disabling-apq
        'enable' => env('GRAPHQL_APQ_ENABLE', false),

        // The cache driver used for APQ
        'cache_driver' => env('GRAPHQL_APQ_CACHE_DRIVER', config('cache.default')),

        // The cache prefix
        'cache_prefix' => config('cache.prefix') . ':graphql.apq',

        // The cache ttl in seconds - See https://www.apollographql.com/docs/apollo-server/performance/apq/#adjusting-cache-time-to-live-ttl
        'cache_ttl' => 300,
    ],

    /*
     * Execution middlewares
     */
    'execution_middleware' => [
        Rebing\GraphQL\Support\ExecutionMiddleware\ValidateOperationParamsMiddleware::class,
        // AutomaticPersistedQueriesMiddleware listed even if APQ is disabled, see the docs for the `'apq'` configuration
        Rebing\GraphQL\Support\ExecutionMiddleware\AutomaticPersistedQueriesMiddleware::class,
        Rebing\GraphQL\Support\ExecutionMiddleware\AddAuthUserContextValueMiddleware::class,
        // \Rebing\GraphQL\Support\ExecutionMiddleware\UnusedVariablesMiddleware::class,
    ],

    /*
     * Globally registered ResolverMiddleware
     */
    'resolver_middleware_append' => null,
];

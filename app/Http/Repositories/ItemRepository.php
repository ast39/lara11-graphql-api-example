<?php

namespace App\Http\Repositories;

use App\Http\Dto\Item\CreateItemDto;
use App\Http\Dto\Item\FilterItemDto;
use App\Http\Dto\Item\UpdateItemDto;
use App\Models\Item;
use App\Models\Scopes\ItemScope;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class ItemRepository {

    protected Item $model;

    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    /**
     * Получить список сущностей
     *
     * @param FilterItemDto $dto
     * @return mixed
     * @throws BindingResolutionException
     */
    public function index(FilterItemDto $dto): mixed
    {
        $order = $data['order'] ?? 'title';
        $reverse = $data['reverse'] ?? 'asc';

        $filter = app()->make(ItemScope::class, [
            'queryParams' => array_filter($dto->toArray(), function($item) {
                return !is_null($item);
            })
        ]);

        $models = $this->model::query()->filter($filter)
            ->orderBy($order, $reverse);

        return is_null($dto->limit ?? null)
            ? $models->get()
            : $models->paginate($dto->limit);
    }

    /**
     * Получить сущность по ID
     *
     * @param int $id
     * @return Item|null
     */
    public function show(int $id):? Model
    {
        return $this->model::find($id);
    }

    /**
     * Создание сущности
     *
     * @param CreateItemDto $dto
     * @return Item
     */
    public function store(CreateItemDto $dto): Model
    {
        return $this->model->create($dto->toArray());
    }

    /**
     * Обновление сущности
     *
     * @param Item $model
     * @param UpdateItemDto $dto
     * @return void
     */
    public function update(Item $model, UpdateItemDto $dto): void
    {
        $dto = collect($dto)->except('id')->toArray();
        $model->update($dto);
    }

    /**
     * Удаление сущности
     *
     * @param Item $model
     * @return void
     */
    public function destroy(Item $model): void
    {
        $model->delete();
    }

    /**
     * Проверить сущность на уникальность названия
     *
     * @param CreateItemDto $dto
     * @return bool
     */
    public function checkItemTitle(CreateItemDto $dto): bool
    {
        return $this->model->where('title', $dto->title)->count() == 0;
    }
}

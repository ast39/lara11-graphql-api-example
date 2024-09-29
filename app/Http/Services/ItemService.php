<?php

namespace App\Http\Services;

use App\Http\Dto\Item\CreateItemDto;
use App\Http\Dto\Item\FilterItemDto;
use App\Http\Dto\Item\UpdateItemDto;
use App\Http\Exceptions\ItemException;
use App\Http\Repositories\ItemRepository;
use App\Models\Item;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;

class ItemService {

    protected ItemRepository $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Список сущностей
     *
     * @param FilterItemDto $dto
     * @return Collection
     * @throws BindingResolutionException
     */
    public function index(FilterItemDto $dto): Collection
    {
        return $this->itemRepository->index($dto);
    }

    /**
     * Сущность по ID
     *
     * @param int $id
     * @return Item
     * @throws ItemException
     */
    public function show(int $id): Item
    {
        $model = $this->itemRepository->show($id);

        if (!$model) {
            throw ItemException::notFound();
        }

        return $model;
    }

    /**
     * Добавление сущности
     *
     * @param CreateItemDto $dto
     * @return Item
     * @throws ItemException
     */
    public function store(CreateItemDto $dto): Item
    {
        if (!$this->itemRepository->checkItemTitle($dto)) {
            throw ItemException::titleNotUnique();
        }

        return $this->itemRepository->store($dto);
    }

    /**
     * Обновление сущности
     *
     * @param UpdateItemDto $dto
     * @return Item
     * @throws ItemException
     */
    public function update(UpdateItemDto $dto): Item
    {
        $model = $this->show($dto->id);
        $this->itemRepository->update($model, $dto);

        return $this->show($dto->id);
    }

    /**
     * Удаление сущности
     *
     * @param int $id
     * @return void
     * @throws ItemException
     */
    public function destroy(int $id): void
    {
        $model = $this->show($id);
        $this->itemRepository->destroy($model);
    }
}

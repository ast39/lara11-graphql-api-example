<?php

namespace App\Http\Repositories;

use App\Http\Dto\Category\CreateCategoryDto;
use App\Http\Dto\Category\FilterCategoryDto;
use App\Http\Dto\Category\UpdateCategoryDto;
use App\Models\Category;
use App\Models\Scopes\CategoryScope;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository {

    protected Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Получить список сущностей
     *
     * @param FilterCategoryDto $dto
     * @return mixed
     * @throws BindingResolutionException
     */
    public function index(FilterCategoryDto $dto): mixed
    {
        $order = $data['order'] ?? 'title';
        $reverse = $data['reverse'] ?? 'asc';

        $filter = app()->make(CategoryScope::class, [
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
     * @return Category|null
     */
    public function show(int $id):? Model
    {
        return $this->model::find($id);
    }

    /**
     * Создание сущности
     *
     * @param CreateCategoryDto $dto
     * @return Category
     */
    public function store(CreateCategoryDto $dto): Model
    {
        return $this->model->create($dto->toArray());
    }

    /**
     * Обновление сущности
     *
     * @param Category $model
     * @param UpdateCategoryDto $dto
     * @return void
     */
    public function update(Category $model, UpdateCategoryDto $dto): void
    {
        $dto = collect($dto)->except('id')->toArray();
        $model->update($dto);
    }

    /**
     * Удаление сущности
     *
     * @param Category $model
     * @return void
     */
    public function destroy(Category $model): void
    {
        $model->delete();
    }

    /**
     * Проверить сущность на уникальность названия
     *
     * @param CreateCategoryDto $dto
     * @return bool
     */
    public function checkCategoryTitle(CreateCategoryDto $dto): bool
    {
        return $this->model->where('title', $dto->title)->count() == 0;
    }
}

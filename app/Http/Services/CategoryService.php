<?php

namespace App\Http\Services;

use App\Http\Dto\Category\CreateCategoryDto;
use App\Http\Dto\Category\FilterCategoryDto;
use App\Http\Dto\Category\UpdateCategoryDto;
use App\Http\Exceptions\CategoryException;
use App\Http\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;

class CategoryService {

    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Список сущностей
     *
     * @param FilterCategoryDto $dto
     * @return Collection
     * @throws BindingResolutionException
     */
    public function index(FilterCategoryDto $dto): Collection
    {
        return $this->categoryRepository->index($dto);
    }

    /**
     * Сущность по ID
     *
     * @param int $id
     * @return Category
     * @throws CategoryException
     */
    public function show(int $id): Category
    {
        $model = $this->categoryRepository->show($id);

        if (!$model) {
            throw CategoryException::notFound();
        }

        return $model;
    }

    /**
     * Добавление сущности
     *
     * @param CreateCategoryDto $dto
     * @return Category
     * @throws CategoryException
     */
    public function store(CreateCategoryDto $dto): Category
    {
        if (!$this->categoryRepository->checkCategoryTitle($dto)) {
            throw CategoryException::titleNotUnique();
        }

        return $this->categoryRepository->store($dto);
    }

    /**
     * Обновление сущности
     *
     * @param UpdateCategoryDto $dto
     * @return Category
     * @throws CategoryException
     */
    public function update(UpdateCategoryDto $dto): Category
    {
        $model = $this->show($dto->id);
        $this->categoryRepository->update($model, $dto);

        return $this->show($dto->id);
    }

    /**
     * Удаление сущности
     *
     * @param int $id
     * @return void
     * @throws CategoryException
     */
    public function destroy(int $id): void
    {
        $model = $this->show($id);
        $this->categoryRepository->destroy($model);
    }
}

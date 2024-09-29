<?php

namespace App\Http\Dto\Category;

use App\Http\Dto\DtoClass;

class UpdateCategoryDto extends DtoClass {

    public ?string $title;

    public int $id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (array_key_exists('title', $data)) {
            $this->title = $data['title'];
        }

       $this->id = $data['id'];
    }
}

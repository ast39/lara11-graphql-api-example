<?php

namespace App\Http\Dto\Category;

use App\Http\Dto\DtoClass;

class CreateCategoryDto extends DtoClass {

    public string $title;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->title = $data['title'];
    }
}

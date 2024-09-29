<?php

namespace App\Http\Dto\Category;

use App\Http\Dto\DtoClass;

class FilterCategoryDto extends DtoClass {

    public ?string $title = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (array_key_exists('title', $data)) {
            $this->title = $data['title'];
        }
    }
}

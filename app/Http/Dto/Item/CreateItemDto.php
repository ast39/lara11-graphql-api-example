<?php

namespace App\Http\Dto\Item;

use App\Http\Dto\DtoClass;

class CreateItemDto extends DtoClass {

    public string $title;
    public string $category_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->title = $data['title'];
        $this->category_id = $data['category_id'];
    }
}

<?php

namespace App\Http\Dto\Item;

use App\Http\Dto\DtoClass;

class UpdateItemDto extends DtoClass {

    public ?string $title;
    public ?int $category_id;

    public int $id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (array_key_exists('title', $data)) {
            $this->title = $data['title'];
        }

        if (array_key_exists('category_id', $data)) {
            $this->category_id = $data['category_id'];
        }

       $this->id = $data['id'];
    }
}

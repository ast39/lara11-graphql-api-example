<?php

namespace App\Http\Dto\Item;

use App\Http\Dto\DtoClass;

class FilterItemDto extends DtoClass {

    public ?string $q = null;
    public ?int $category_id = null;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (array_key_exists('q', $data)) {
            $this->q = $data['q'];
        }

        if (array_key_exists('category_id', $data)) {
            $this->category_id = $data['category_id'];
        }
    }
}

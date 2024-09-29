<?php

namespace App\Http\Exceptions;

class ItemException extends \Exception {

    /**
     * @var mixed
     */
    protected $message;

    /**
     * @var int|mixed
     */
    protected $code = 400;

    public function __construct($message = null, $code = null)
    {
        if ($message) {
            $this->message = $message;
        }
        if ($code) {
            $this->code = $code;
        }

        parent::__construct($this->message, $this->code);
    }

    /**
     * Исключение - Товар не найден
     *
     * @return ItemException
     */
    public static function notFound(): ItemException
    {
        return new static('Категория не найдена', 404);
    }

    /**
     * Исключение - Товар с таким названием уже существует
     *
     * @return ItemException
     */
    public static function titleNotUnique(): ItemException
    {
        return new static('Категория с таким названием уже существует', 400);
    }
}

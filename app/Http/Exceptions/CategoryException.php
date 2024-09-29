<?php

namespace App\Http\Exceptions;

class CategoryException extends \Exception {

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
     * Исключение - Категория не найдена
     *
     * @return CategoryException
     */
    public static function notFound(): CategoryException
    {
        return new static('Категория не найдена', 404);
    }

    /**
     * Исключение - Категория с таким названием уже существует
     *
     * @return CategoryException
     */
    public static function titleNotUnique(): CategoryException
    {
        return new static('Категория с таким названием уже существует', 400);
    }
}

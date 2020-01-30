<?php

namespace Modules\Directory\Repositories;

use Illuminate\Database\Eloquent\Model;

/*
 *  Class CoreRepository
 * @package Modules\Directory\Repositories
 *
 * Репозиторий работы с сущностью
 * Может выдавать наборы данных
 * Не может создавать/изменять сущности
 *
 * */

/**
 * Class CoreRepository
 * @package Modules\Directory\Repositories
 */
abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Берет имя модели из порождающего потомка
     *
     * CoreRepository constructor.
     */
    function __construct()
    {


        $this->model = app($this->getModelClass());
        // то же что и первй способ, но в первом  мы делигируем laravel, функции app
        // если делать через - будет в ры быстрее
//      $this->model = new $this->getModelClass();
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * Клонируем созданную модель, чтобы не пересекалась модель вразных метстах кода
     * Один контроллер навест одни условия , другой в другом месте другие - не отследишь
     *
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}

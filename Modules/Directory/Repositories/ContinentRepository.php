<?php


namespace Modules\Directory\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContinentRepository extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Прлучить модель для редактирования
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        dd('asdad');
        return $this->startConditions()->find($id);
    }


    /**
     * Получить все континенты
     * @return Collection
     */
    public function getAllContinents()
    {
        return $this->startConditions()->all();
    }
}

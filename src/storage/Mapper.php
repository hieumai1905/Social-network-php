<?php

namespace storage;

class Mapper
{
    public static function mapStdClassToModel($stdClass, $modelClass): object
    {
        $model = new $modelClass();

        foreach ($stdClass as $key => $value) {
            $setter = 'set' . ucfirst($key);

            if (method_exists($model, $setter)) {
                $model->$setter($value);
            } else {
                $setter = lcfirst(str_replace('_', ' ', $key));
                $setter = 'set'. ucwords($setter);
                $setter = str_replace(' ', '', $setter);
                $model->$setter($value);
            }
        }
        return $model;
    }
}
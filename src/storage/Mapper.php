<?php

namespace storage;

use ReflectionClass;

class ÎMapper
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
                $setter = 'set' . ucwords($setter);
                $setter = str_replace(' ', '', $setter);
                $model->$setter($value);
            }
        }
        return $model;
    }

    /**
     * @throws \ReflectionException
     */
    public static function mapModelToJson($model): array
    {
        $data = [];
        $reflection = new ReflectionClass($model);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            $getter = 'get' . ucfirst($name);
            if (method_exists($model, $getter)) {
                $value = $model->$getter();
                if ($value === null) {
                    $data[$name] = null;
                } else {
                    $data[$name] = $value;
                }

            }

        }
        return $data;

    }
}
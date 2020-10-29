<?php

namespace denis909\yii;

use Yii;
use Exception;

trait ActiveRecordTrait
{

    public static function instantiate($row)
    {
        $row['class'] = static::class;

        return Yii::createObject($row);
    }

    public function saveOrFail($runValidation = true, $attributeNames = null)
    {
        $return = parent::save($runValidation, $attributeNames);

        if (!$return)
        {
            throw new ModelException($this);
        }

        return $return;
    }

    public function deleteOrFail()
    {
        $return = parent::delete();

        if ($return === false)
        {
            throw new Exception('The deletion is unsuccessful for some reason.');
        }

        return $return;
    }

    public static function createOrFail(array $attributes, bool $refresh = true)
    {
        $model = static::instantiate($attributes);

        $model->saveOrFail();

        if ($refresh)
        {
            $model->refresh();
        }

        return $model;
    }

    public static function findOrCreate($where, array $attributes = [], bool $refresh = true)
    {
        $return = static::findOne($where);

        if ($return)
        {
            return $return;
        }

        if (is_array($where))
        {
            $attributes = array_merge($where, $attributes);
        }

        return static::createOrFail($attributes, $refresh);
    }

}
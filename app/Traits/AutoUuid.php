<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait AutoUuid
{
    protected static function bootAutoUuid()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public static function uuid(){
        return (string) Str::uuid();
    }
}

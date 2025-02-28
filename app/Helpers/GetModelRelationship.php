<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Relations\Relation;
use ReflectionClass;
use ReflectionMethod;

class GetModelRelationship {

    public static function getRelationships($model)
    {
        $relationships = [];
        $methods = (new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            if ($method->class == get_class($model) && $method->getNumberOfParameters() === 0) {
                try {
                    $returnType = $method->invoke($model);
                    if ($returnType instanceof Relation) {
                        $relationships[] = $method->getName();
                    }
                } catch (\Throwable $e) {
                    continue;
                }
            }
        }

        return $relationships;
    }

}
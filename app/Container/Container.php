<?php

namespace App\Container;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;

class Container
{
    protected $items = [];

    public function set($name, $callable)
    {
        $this->items[$name] = $callable;
    }

    public function singleton($name, $callable)
    {
        $this->items[$name] = function () use ($callable) {
            static $resolved;

            if(!$resolved){
                $resolved = $callable();
            }

            return $resolved;
        };
    }

    public function get($name)
    {
        if($this->has($name)){
            return $this->items[$name]($this);
        }

        return $this->autowire($name);
    }

    private function autowire($name){

        if(!class_exists($name)){
            throw new Exception("error");
        }

        $reflector = new ReflectionClass($name);

        if (!$reflector->isInstantiable()){
            throw new Exception("error");
        }

        if ($constructor = $reflector->getConstructor()){
            return $reflector->newInstanceArgs(
                $this->getReflectionConstructorDependecies($constructor)
            );
        }
        return new $name();
    }

    private function getReflectionConstructorDependecies(ReflectionMethod $constructor)
    {
        return array_map(function(ReflectionParameter $dependency){
            return $this->resolveReflectedDependency($dependency);
        }, $constructor->getParameters());
    }

    private function resolveReflectedDependency(ReflectionParameter $dependency)
    {
        if(is_null($class = $dependency->getClass())){
            throw new Exception('not found');
        }
        return $this->get($class->getName());
    }

    private function has($name)
    {
        return isset($this->items[$name]);
    }

    public function __get($name)
    {
        return $this->get($name);
    }
}

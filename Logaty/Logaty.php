<?php

namespace PHPtricks\Logaty;

use Prophecy\Doubler\ClassPatch\ReflectionClassNewInstancePatch;
use ReflectionClass;
use ReflectionParameter;

class Logaty
{

    private static Logaty $_instance;
    private array $_instances = [];
    private array $_cache = [];

    private function __construct()
    {}

    public static function up()
    {
        if(!isset(static:: $_instance) || static:: $_instance === null) {
            static:: $_instance = new Logaty();
        }

        return static:: $_instance;
    }

    public function get(string $class)
    {
        if($this->cached($class)) {
            return $this->restore($class);
        }

        if(!$this->has($class)) {
            $this->set($class);
        }
        
        $resolvedClass = $this->resolve(
            $this->_instances[$class]
        );
        $this->store($class, $resolvedClass);

        return $resolvedClass;
    }

    public function has(string $class) : bool
    {
        return isset($this->_instances[$class]);
    }

    public function set(string $class, callable $concrete = null) : void
    {
        if(!$concrete) {
            $concrete = $class;
        }

        $this->_instances[$class] = $concrete;
    }

    public function resolve(string $concrete)
    {
        $class = new ReflectionClass($concrete);

        if(!$class->isInstantiable()) {
            throw new \Exception("class {$class->name} is not instantiable");
        }

        $constructor = $class->getConstructor();

        if(is_null($constructor)) {
            return $class->newInstance();
        }

        $params = $constructor->getParameters();

        $dependencies = $this->getDependencies($class, $params);

        return $class->newInstanceArgs($dependencies);
    }

    private function getDependencies(ReflectionClass $class, array $params) : array
    {
        $dependencies = [];
        foreach($params as $param) {
            $dependency = $param->getType();
            if(is_null($dependency)) {
                if($param->isDefaultValueAvilable()) {
                    $dependencies[] = $param->getDefaultValue();
                } else {
                    throw new \Exception("No Default value");
                }
            } else {
                $dependencies[] = $this->get($dependency);
            }
        }

        return $dependencies;
    }

    private function store(string $class, object $reflection) : void
    {
        $this->_cache[$class] = serialize($reflection);
    }

    private function restore(string $class)
    {
        return unserialize($this->_cache[$class]);
    }

    private function cached(string $class): bool
    {
        return isset($this->_cache[$class]);
    }
}
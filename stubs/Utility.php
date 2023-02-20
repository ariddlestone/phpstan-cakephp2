<?php

class ClassRegistry
{
    /**
     * @var array<string,mixed>
     */
    protected $_objects = array();

    /**
     * @var array<string,mixed>
     */
    protected $_map = array();

    /**
     * @var array<string,mixed>
     */
    protected $_config = array();

    /**
     * @return ClassRegistry
     */
    public static function getInstance(): ClassRegistry {}

    /**
     * @template T
     * @param class-string<T>|string|array<mixed> $class
     * @param bool $strict
     * @return ($class is class-string<T> ? T : (bool|object))
     */
    public static function init($class, bool $strict = false) {}

    /**
     * @param string $key
     * @param object $object
     * @return bool
     */
    public static function addObject(string $key, object $object): bool {}

    /**
     * @param string $key
     * @return void
     */
    public static function removeObject(string $key): void {}

    /**
     * @param string $key
     * @return bool
     */
    public static function isKeySet(string $key): bool {}

    /**
     * @return array<string>
     */
    public static function keys(): array {}

    /**
     * @param string $key
     * @return object|false
     */
    public static function getObject(string $key) {}

    /**
     * @param string $type
     * @param array<mixed> $param
     * @return mixed
     */
    public static function config(string $type, array $param = array()) {}

    /**
     * @param string $alias
     * @param string $class
     * @return object|false
     */
    protected function &_duplicate(string $alias, string $class) {}

    /**
     * @param string $key
     * @param string $name
     * @return void
     */
    public static function map(string $key, string $name): void {}

    /**
     * @return array<string> Keys of registry's map
     */
    public static function mapKeys(): array {}

    /**
     * @param string $key
     * @return string
     */
    protected function _getMap(string $key): string {}

    /**
     * @return void
     */
    public static function flush(): void {}
}

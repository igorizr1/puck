<?php
/**
 * Created by PhpStorm.
 * User: codestack
 * Date: 10.05.15
 * Time: 15:23
 */

namespace Bonny\Helpers;

use Bonny\Core\ComponentManager;


/**
 * Общий интерфейс пула одиночек
 */
abstract class MultitonAbstract
{

    /**
     * @var array
     */
    protected static $instances = array();


    /**
     * Возвращает экземпляр класса, из которого вызван
     *
     * @return static
     */
    public static function getInstance()
    {
        $className = static::getClassName();
        if (!(self::$instances[$className] instanceof $className)) {
            $instance = new $className();
//            $instance->init();
            self::$instances[$className] = $instance;
        }
        return self::$instances[$className];
    }

//    abstract protected function init();

    /**
     * Удаляет экземпляр класса, из которого вызван
     *
     * @return void
     */
    public static function removeInstance()
    {
        $className = static::getClassName();
        if (array_key_exists($className, self::$instances)) {
            unset(self::$instances[$className]);
        }
    }

    /**
     * Возвращает имя экземпляра класса
     *
     * @return string
     */
    final protected static function getClassName()
    {
        return get_called_class();
    }

    /**
     * Конструктор закрыт
     */
    protected function __construct(){}
//    final protected function __construct(){}

    /**
     * Клонирование запрещено
     */
    final protected function __clone(){}

    /**
     * Сериализация запрещена
     */
    final protected function __sleep(){}

    /**
     * Десериализация запрещена
     */
    final protected function __wakeup(){}
}

/**
 * Интерфейс пула одиночек
 */
abstract class SingletonAbstract extends MultitonAbstract
{

    /**
     * Возвращает экземпляр класса, из которого вызван
     *
     * @return static
     */
    final public static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     * Удаляет экземпляр класса, из которого вызван
     *
     * @return void
     */
    final public static function removeInstance()
    {
        parent::removeInstance();
    }

}

abstract class Singleton extends SingletonAbstract{

}

/**
 * Class SingletonCM
 * @package Puck\Helpers
 *
 * Singleton where you can pass ComponentManager as param to getInstance
 *
 */
abstract class SingletonCM extends MultitonAbstract{

    final public static function getInstance(ComponentManager $cm)
    {
        $className = static::getClassName();
        if (!(self::$instances[$className] instanceof $className)) {
            $instance = new $className();
            $instance->init($cm);
            self::$instances[$className] = $instance;
        }
        return self::$instances[$className];
    }

    final public static function removeInstance()
    {
        parent::removeInstance();
    }

    abstract protected function init(ComponentManager $cm);
}
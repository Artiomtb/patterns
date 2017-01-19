<?php

/**
 * Class Autoloader
 */
class Autoloader
{
    /**
     * @var array   Namespace mapping
     */
    protected static $ns_map = [];

    /**
     * Autoloader constructor.
     */
    public function __construct()
    {
        spl_autoload_register([$this, 'load']);
    }

    /**
     * Register namespace root path
     *
     * @param $namespace    Root namespace
     * @param $root_path    Namespace root path
     */
    public static function addNamspacePath($namespace, $root_path){
        self::$ns_map[$namespace] = $root_path;
    }

    /**
     * Load class
     *
     * @param $classname    Class name
     */
    protected function load($classname){
        if($path = $this->getClassPath($classname) ){
            require_once $path;
        }
    }

    /**
     * Get realpath to the class definition file
     */
    protected function getClassPath($classname){
        $class_path = $classname . '.php';
        if( !empty(self::$ns_map) ){
            foreach(self::$ns_map as $ns => $path){
                $lookup_pattern = sprintf('/^%s/', $ns);
                if(preg_match($lookup_pattern, $classname)){
                    $class_path = preg_replace($lookup_pattern, $path, $class_path);
                    break;
                }
            }
        }
        self::addNamspacePath($classname, $class_path);
        return realpath(str_replace('\\', DIRECTORY_SEPARATOR, $class_path));
    }
}

new Autoloader();
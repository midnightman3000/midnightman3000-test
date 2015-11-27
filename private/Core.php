<?php

namespace Alex;

use Symfony\Component\Yaml\Parser as YamlParser;
use Alex\Helper\CoreHelper;

class Core
{
    private static $yamlPareser;
    
    private static $systemConfig;
    
    private static function getYamlParser()
    {
        if (!self::$yamlPareser) {
            self::$yamlPareser = new YamlParser();
        }
        return self::$yamlPareser;
    }
    
    private static function parseYamlFile($file)
    {
        if (!file_exists($file)) {
            throw new \Exception('Configuration file not found ' . $file);
        }
        
        return self::getYamlParser()->parse(file_get_contents($file));
    }
    
    public static function getConfig($section, $key = '')
    {
        if (empty(self::$systemConfig)) {
            self::$systemConfig = self::parseYamlFile(CONFIG_FILE);
        }
        if (!isset(self::$systemConfig[$section])) {
            throw new \Exception('Config section "' . $section . '" not found');
        }
        
        $value = self::$systemConfig[$section];
        
        if (!empty($key)) {
            if (!isset($value[$key])) {
                throw new \Exception('Config key "' . $key . '" not found');
            }
            $value = $value[$key];
        }
        
        return $value;
    }

    public static function init()
    {
        CoreHelper::initKeys();
    }
}
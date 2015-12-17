<?php

namespace Alex\Helper;

use Symfony\Component\Yaml\Parser as YamlParser;

class CoreHelper
{
	const KEY_DIRECTORY = 'keys';

	const PUBLIC_KEY = 'pub.key'; 
	const PRIVATE_KEY = 'priv.key'; 

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
    
    public function getConfig($section, $key = '')
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
    
	public static function getKeyDirectory()
	{
		return SYSTEM_PATH . self::KEY_DIRECTORY . DIRECTORY_SEPARATOR;
	}

	/**
	 * Keys initialization
	 * @return null
	 */
	public static function initKeys()
	{
		if (!file_exists(self::getKeyDirectory() . self::PUBLIC_KEY)) {
			self::generateKey(self::PUBLIC_KEY);
		}

		if (!file_exists(self::getKeyDirectory() . self::PRIVATE_KEY)) {
			self::generateKey(self::PRIVATE_KEY);
		}
	}

	/**
	 * Generate key by given name
	 * @param string $keyFilename path where key should be placed
	 */
	private static function generateKey($keyFilename)
	{
		$key = self::randomString(256);
		file_put_contents(SYSTEM_PATH . self::KEY_DIRECTORY . DIRECTORY_SEPARATOR . $keyFilename, $key);
	}

	/**
	 * Generate a random string, using a cryptographically secure 
	 * pseudorandom number generator (random_int)
	 * 
	 * For PHP 7, random_int is a PHP core function
	 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
	 * 
	 * @param int $length      How many characters do we want?
	 * @param string $keyspace A string of all possible characters
	 *                         to select from
	 * @return string
	 */
	private static function randomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[mt_rand(0, $max)];
	    }
	    return $str;
	}
}
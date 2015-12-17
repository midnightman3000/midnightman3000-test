<?php

namespace Alex\Service;

class Storage
{
	private static $defaultStorage;

	public static function getDefaultStorage()
	{
		if (!isset(self::$defaultStorage)) {
			$defaultStorage = Core::getHelper()->getConfig('storage', 'default');
			$defaultStorageClass = 'Storage\\' . ucfirst($defaultStorage);
			self::$defaultStorage = new $defaultStorage(Core::getHelper()->getConfig('storage', $defaultStorage));
		}
		return self::$defaultStorage;
	}
}
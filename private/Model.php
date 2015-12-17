<?php

namespace Alex;

use Alex\Service\Storage;

class Model
{
	public function getModelIdentifier()
	{
		$class = get_called_class($this);
		$classParts = explode('\\', $class);
		return strtolower(end($classParts));
	}

	public function load($modelId)
	{
		Storage::getDefaultStorage()->load($this->getModelIdentifier(), $modelId);
	}

	public function save($modelId)
	{
		Storage::getDefaultStorage()->save($this);
	}

	public function __construct($modelId = null)
	{
		if (isset($modelId) && !empty($modelId)) {
			$this->load($modelId);
		}
		return $this;
	}

	public function __call($name, $params)
	{
		$possibleProperty = $this->cleanupFunctionCall($name);
		if (strpos($name, 'get') === 0) {
			return $this->$possibleProperty;
		} elseif (strpos($name, 'set') === 0) {
			$this->$possibleProperty = $params[0];
		} elseif(strpos($name, 'change') === 0) {
			$this->$possibleProperty = $params[0];
			$methodName = 'on' . ucfirst($possibleProperty) . 'Change';
			if (method_exists($this, $methodName)) {
				call_user_func([$this, $methodName], $params);
			}
		}
	}

	private function cleanupFunctionCall($function)
	{
		return strtolower(preg_replace("/^(get|set|change)(.*)/", "$2", $function));
	}
}
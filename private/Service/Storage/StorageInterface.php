<?php

namespace Alex\Service\Storage;

interface StorageInterface
{
	public function load($object, $id);
	public function save($object);
}
<?php

namespace Alex\Model;


class User extends \Alex\Model
{
	public $user_id;
	public $name = 'test';

	public function onNameChange()
	{
		echo 'On name change rise!';
	}
}
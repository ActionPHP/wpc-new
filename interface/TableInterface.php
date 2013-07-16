<?php

interface TableInterface
{

	public function create($object);
	public function get($id=null);
	public function update($object);
	public function delete($id);
	public function getBy($field, $value);

			
}
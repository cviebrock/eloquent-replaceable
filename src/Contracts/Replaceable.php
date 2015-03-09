<?php namespace Cviebrock\EloquentReplaceable\Contracts;

interface Replaceable {

	public function getReplacements();

	public function getReplaceables();

	public function doReplacements($key);

}

<?php namespace Cviebrock\EloquentReplaceable\Traits;

trait ReplaceableImp {

	/**
	 * Overload Eloquent getAttribute() method to look for and handle replacements.
	 *
	 * @param $key
	 * @return mixed
	 */
	public function getAttribute($key) {

		$value = parent::getAttribute($key);

		if (array_get($this->getReplaceableAttributes(), $key)) {
			$value = $this->processReplacements($value);
		}

		return $value;
	}


	/**
	 * Get array of attributes that can contain placeholders.
	 *
	 * @return array
	 */
	public function getReplaceableAttributes() {
		return [];
	}


	/**
	 * Get array of replacement strings/functions for each of the placeholders.
	 *
	 * @return array
	 */
	public function getReplacements() {
		return [];
	}


	protected function processReplacements() {

		$keys = preg_match('/:(.*+)\b/', $key);
		dd($keys);
	}
}

<?php namespace Cviebrock\EloquentReplaceable\Traits;

trait ReplaceableImp {

	/**
	 * Get array of replacement strings/functions for each of the placeholders.
	 *
	 * @return array
	 */
	protected function getReplaceaments() {
		return [];
	}


	/**
	 * Get array of attributes that can contain placeholders.
	 *
	 * @return array
	 */
	protected function getReplaceableAttributes() {
		return [];
	}


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

	protected function processReplacements() {

		$keys = preg_match('/:(.*+)\b/', $key);
		dd($keys);

	}
}

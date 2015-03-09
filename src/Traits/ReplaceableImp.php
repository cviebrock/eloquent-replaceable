<?php namespace Cviebrock\EloquentReplaceable\Traits;

use Illuminate\Support\Collection;


trait ReplaceableImp {

	protected $replacementCache = [];


	/**
	 * Overload Eloquent getAttribute() method to look for and handle replacements.
	 *
	 * @param $key
	 * @return mixed
	 */
	public function doReplacements($key) {

		$value = $this->getAttribute($key);

		if ($replacements = array_get($this->getReplaceables(), $key)) {
			$value = $this->processReplacements($value, $replacements);
		}

		return $value;
	}


	/**
	 * Array of model attributes that should be checked for placeholder replacements.
	 *
	 * @return array
	 */
	public function getReplaceables() {
		return [];
	}


	/**
	 * Get array of replacement strings/functions for each of the placeholders.
	 * This is a function instead of a class property so you can use closures
	 * as replacement values.
	 *
	 * @return array
	 */
	public function getReplacements() {
		return [];
	}


	/**
	 * Process the template with the given replacement values/functions.
	 *
	 * @param $value string
	 * @param $replacements array
	 * @return string
	 */
	protected function processReplacements($value, $replacements) {

		// sort by reverse length to prevent placeholder collision
		$replacements = (new Collection($replacements))->sortBy(function ($r) {
			return mb_strlen($r) * -1;
		});

		foreach ($replacements as $placeholder) {

			$replacement = $this->getReplacementValue($placeholder);

			$value = str_replace(':' . $placeholder, $replacement, $value);
		}

		return $value;
	}


	/**
	 * Get the replacement value for a given placeholder
	 *
	 * @param $placeholder string
	 * @return mixed
	 */
	protected function getReplacementValue($placeholder) {
		if (array_key_exists($placeholder, $this->replacementCache)) {
			$replacement = $this->replacementCache[$placeholder];

			return $replacement;
		} else {
			$replacement = array_get($this->getReplacements(), $placeholder);
			if (is_callable($replacement)) {
				$replacement = call_user_func($replacement, $this);
			}
			$this->replacementCache[$placeholder] = $replacement;

			return $replacement;
		}
	}
}

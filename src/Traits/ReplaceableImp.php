<?php namespace Cviebrock\EloquentReplaceable\Traits;

use Config;


trait ReplaceableImp {

	/**
	 * The internal cache of the attribute->placeholder array for this model.
	 *
	 * @var null|array
	 */
	protected $placeholdersCache;

	/**
	 * The internal cache of the placeholder->replacement array for this model.
	 *
	 * @var null|array
	 */
	protected $replacementsCache;

	/**
	 * The internal cache of the placeholder->value array for this model.
	 *
	 * @var null|array
	 */
	protected $replacementValuesCache = [];


	/**
	 * Returns the attribute with all replacements done.
	 *
	 * @param $attribute
	 * @return string
	 */
	public function doReplacements($attribute) {

		$value = $this->getAttribute($attribute);

		if ($placeholders = $this->getPlaceholders($attribute)) {
			$value = $this->processReplacements($value, $placeholders);
		}

		return $value;
	}


	/**
	 * Returns an array of placeholders that should be replaced for the given
	 * attribute.
	 *
	 * @param $attribute
	 * @return array
	 */
	public function getPlaceholders($attribute) {

		$placeholders = array_get($this->getAllPlaceholders(), $attribute);
		if ($placeholders == '*') {
			$placeholders = array_keys($this->getAllReplacements());
			$this->placeholdersCache[$attribute] = $placeholders;
		}

		return $placeholders;
	}


	/**
	 * Process the template with the given replacement values/functions.
	 *
	 * @param $template string
	 * @param $placeholders array
	 * @return string
	 */
	protected function processReplacements($template, $placeholders) {

		// sort by reverse length to prevent placeholder collision
		usort($placeholders, function ($a, $b) {
			return mb_strlen($a) < mb_strlen($b);
		});

		foreach ($placeholders as $placeholder) {

			$replacement = $this->getReplacementValue($placeholder);

			$template = str_replace(':' . $placeholder, $replacement, $template);
		}

		return $template;
	}


	/**
	 * Get the attribute=>placeholders array for this model.
	 *
	 * @return array
	 */
	protected function getAllPlaceholders() {
		if (!is_array($this->placeholdersCache)) {
			$modelPlaceholders = Config::get('replaceable::' . get_called_class() . '.attributes', []);
			$globalPlaceholders = Config::get('replaceable::*.attributes', []);
			$this->placeholdersCache = array_merge($globalPlaceholders, $modelPlaceholders);
		}

		return $this->placeholdersCache;
	}


	/**
	 * Get the placeholder=>replacement array for this model.
	 *
	 * @return array
	 */
	protected function getAllReplacements() {
		if (!is_array($this->replacementsCache)) {
			$modelReplacements = Config::get('replaceable::' . get_called_class() . '.replacements', []);
			$globalReplacements = Config::get('replaceable::*.replacements', []);
			$this->replacementsCache = array_merge($globalReplacements, $modelReplacements);
		}

		return $this->replacementsCache;
	}


	/**
	 * Get the replacement value for a given placeholder
	 *
	 * @param $placeholder string
	 * @return mixed
	 */
	protected function getReplacementValue($placeholder) {
		if (array_key_exists($placeholder, $this->replacementValuesCache)) {
			return $this->replacementValuesCache[$placeholder];
		}

		$value = array_get($this->getAllReplacements(), $placeholder);
		if (is_callable($value)) {
			$value = call_user_func($value, $this);
		}
		$this->replacementValuesCache[$placeholder] = $value;

		return $value;
	}
}

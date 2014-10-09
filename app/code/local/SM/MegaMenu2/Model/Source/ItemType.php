<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/7/14
 * Time: 2:29 AM
 */
class SM_MegaMenu2_Model_Source_ItemType
{
	const CATEGORY          = 1;
	const CATEGORY_LABEL    = 'Category';

	const BLOCK             = 2;
	const BLOCK_LABEL       = 'Static Block';

	const LINK              = 3;
	const LINK_LABEL        = 'Link';

	/** @var array List of options */
	protected $_options = null;

	public function getAllOptions()
	{
		// Build a new list of options if not built yet
		if ($this->_options === null) {
			$options = array();

			$classReflection    = new ReflectionClass(get_class($this));
			$constants          = $classReflection->getConstants();

			while (true) {
				$options[] = array(
					'value' => array_shift($constants),
					'label' => array_shift($constants)
				);

				// Break the loop if there is nothing more in the array of constants
				if (empty($constants)) break;
			}

			$this->_options = $options;
		}

		return $this->_options;
	}

	public function getOptionsArray() {
		$options = array();

		$classReflection    = new ReflectionClass(get_class($this));
		$constants          = $classReflection->getConstants();

		while (true) {
			$options[array_shift($constants)] = array_shift($constants);

			// Break the loop if there is nothing more in the array of constants
			if (empty($constants)) break;
		}

		return $options;
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: namma
 * Date: 10/2/14
 * Time: 2:02 PM
 */
class SM_ProductLabel_Model_Source_LabelPosition extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {

	const POS_TOP               = 'sm-label-top';
	const POS_TOP_LABEL         = 'Top';

	const POS_BOTTOM            = 'sm-label-bottom';
	const POS_BOTTOM_LABEL      = 'Bottom';

	const POS_LEFT              = 'sm-label-left';
	const POS_LEFT_LABEL        = 'Left';

	const POS_RIGHT             = 'sm-label-right';
	const POS_RIGHT_LABEL       = 'Right';

	const POS_TOP_LEFT          = 'sm-label-top sm-label-left';
	const POS_TOP_LEFT_LABEL    = 'Top Left';

	const POS_TOP_RIGHT         = 'sm-label-top sm-label-right';
	const POS_TOP_RIGHT_LABEL   = 'Top Right';

	const POS_BOTTOM_LEFT       = 'sm-label-bottom sm-label-left';
	const POS_BOTTOM_LEFT_LABEL = 'Bottom Left';

	const POS_BOTTOM_RIGHT      = 'sm-label-bottom sm-label-right';
	const POS_BOTTOM_RIGHT_LABEL= 'Bottom Right';

	public function getAllOptions() {
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

		return $options;
	}

}
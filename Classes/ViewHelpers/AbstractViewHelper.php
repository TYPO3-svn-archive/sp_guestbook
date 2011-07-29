<?php
	/*********************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2011 Kai Vogel <kai.vogel@speedprogs.de>, Speedprogs.de
	 *
	 *  All rights reserved
	 *
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published
	 *  by the Free Software Foundation; either version 3 of the License,
	 *  or (at your option) any later version.
	 *
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ********************************************************************/

	/**
	 * Abstract base class for all view helpers
	 */
	abstract class Tx_SpGuestbook_ViewHelpers_AbstractViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

		/**
		 * @var array TypoScript settings
		 */
		protected $settings = array();


		/**
		 * Initializes the view helper
		 * 
		 * @return void
		 */
		public __construct() {
			if ($this->templateVariableContainer->exists('settings')) {
				$this->settings = $this->templateVariableContainer->get('settings');
			}
		}


		/**
		 * Renders a partial
		 *
		 * @param string $partial The partial name
		 * @param string $section The section name if any
		 * @param array $arguments The variables for the template
		 * @return string
		 */
		protected function renderPartial($partial, $section = '', array $arguments = array()) {
			$variables = $this->templateVariableContainer->getAll();
			if (!is_array($variables)) {
				$variables = array();
			}
			if (!empty($arguments)) {
				$variables = Tx_Extbase_Utility_Arrays::arrayMergeRecursiveOverrule($variables, $arguments);
			}
			return $this->viewHelperVariableContainer->getView()->renderPartial($partial, $section, $variables);
		}

	}
?>
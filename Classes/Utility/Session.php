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
	 * Utility methods for session
	 */
	class Tx_SpGuestbook_Utility_Session {

		/**
		 * @var string
		 */
		static protected $sessionName = 'sp_guestbook';

		/**
		 * @var array
		 */
		static protected $sessionContent;


		/**
		 * Load session content
		 *
		 * @return void
		 */
		static public function load() {
			if (empty($GLOBALS['TSFE']->fe_user)) {
				throw new Exception('Extension sp_guestbook: Could not load session without frontend user', 1308306000);
			}
			if (empty(self::$sessionContent)) {
				self::$sessionContent = $GLOBALS['TSFE']->fe_user->getKey('ses', self::$sessionName);
			}
		}


		/**
		 * Save session content
		 *
		 * @return void
		 */
		static public function save() {
			if (empty($GLOBALS['TSFE']->fe_user)) {
				throw new Exception('Extension sp_guestbook: Could not save session without frontend user', 1308306001);
			}
			$GLOBALS['TSFE']->fe_user->setKey('ses', self::$sessionName, self::$sessionContent);
			$GLOBALS['TSFE']->storeSessionData();
		}


		/**
		 * Add a value to session
		 *
		 * @param string $key Name of the value
		 * @param mixed $value Value content
		 * @return void
		 */
		static public function addValue($key, $value) {
			if (empty($key)) {
				throw new Exception('Extension sp_guestbook: Empty keys are not allowed for a session value', 1308306002);
			}
			self::$sessionContent[$key] = $value;
		}


		/**
		 * Add multiple values to session
		 *
		 * @param array $value Key <-> value pairs
		 * @return void
		 */
		static public function addValues(array $values) {
			foreach ($values as $key => $value) {
				self::addValue($key, $value);
			}
		}


		/**
		 * Check if session contains given value key
		 *
		 * @param string $key Name of the value
		 * @return boolean TRUE if exists
		 */
		static public function hasValue($key) {
			return isset(self::$sessionContent[$key]);
		}


		/**
		 * Get value from session
		 *
		 * @param string $key Name of the value
		 * @return mixed Value content
		 */
		static public function getValue($key) {
			if (self::hasValue($key)) {
				return self::$sessionContent[$key];
			}
			return NULL;
		}


		/**
		 * Get all values from session
		 *
		 * @return array Session content
		 */
		static public function getAllValues() {
			if (!empty(self::$sessionContent)) {
				return self::$sessionContent;
			}
			return array();
		}

	}
?>
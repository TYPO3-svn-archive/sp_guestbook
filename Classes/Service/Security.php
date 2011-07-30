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
	 * Service for spam check
	 */
	class Tx_SpGuestbook_Service_Security implements t3lib_Singleton {

		/**
		 * @var tslib_cObj
		 */
		protected $contentObject;

		/**
		 * @var array
		 */
		protected $configuration;


		/**
		 * @param Tx_Extbase_Configuration_ConfigurationManager $configurationManager
		 * @return void
		 */
		public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $configurationManager) {
			$this->contentObject = $configurationManager->getContentObject();
		}


		/**
		 * Set TypoScript configuration
		 *
		 * @param array $configuration TypoScript configuration
		 * @return void
		 */
		public function setConfiguration(array $configuration) {
			$this->configuration = $configuration;
		}


		/**
		 * Check referer
		 * 
		 * @return boolean TRUE if refer is valid
		 */
		public function checkReferer() {
			$refererHost = @parse_url(t3lib_div::getIndpEnv('HTTP_REFERER'), PHP_URL_HOST);
			return ($refererHost === t3lib_div::getIndpEnv('HTTP_HOST'));
		}


		/**
		 * Check hidden fields
		 * 
		 * @param Tx_Extbase_MVC_RequestInterface $request Current request
		 * @return boolean TRUE if hidden fields are empty
		 */
		public function checkHiddenFields(Tx_Extbase_MVC_RequestInterface $request) {
			$arguments = $request->getArguments();
			
			// Todo
		}


		/**
		 * Check elapsed time since page was loaded
		 * 
		 * @param integer $timestamp Timestamp when page was loaded
		 * @param integer $seconds Minimum required time to fill out the form
		 * @return boolean TRUE if minimum time was reached
		 */
		public function checkElapsedTime($timestamp, $seconds = 2) {
			return (($GLOBALS['EXEC_TIME'] - (int) $seconds) > (int) $timestamp);
		}


		/**
		 * Check count of entries made by current user
		 * 
		 * @param integer $allowedEntries Count of allowed entries
		 * @param integer $waitingTime Waiting time if count was reached
		 * @return boolean TRUE if count was not reached
		 */
		public function checkEntryCount($allowedEntries = 10, $waitingTime = 60) {
			Tx_SpGuestbook_Utility_Session::load();

				// Check entry count
			$entryCount = Tx_SpGuestbook_Utility_Session::getValue('entryCount');
			if ((int) $entryCount < (int) $allowedEntries) {
				return TRUE;
			}

				// Check lock time
			$loadTime = Tx_SpGuestbook_Utility_Session::getValue('loadTime');
			if (empty($loadTime)) {
				throw new Exception('Extension sp_guestbook: No valid page load time found', 1308305990);
			}
			if ($GLOBALS['EXEC_TIME'] > ($loadTime + ((int) $waitingTime * 60))) {
				return TRUE;
			}

			return FALSE;
		}

	}
?>
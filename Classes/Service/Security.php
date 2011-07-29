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
		 * @param Tx_Extbase_Configuration_ConfigurationManager $configurationManager
		 * @return void
		 */
		public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $configurationManager) {
			$this->contentObject = $configurationManager->getContentObject();
		}


		/**
		 * Check captcha input
		 *
		 * @param string $extensionName Extension key of the captcha extension
		 * @return FALSE if the test failes
		 */
		protected function checkCaptcha ($extensionName) {
			if (empty($extensionName)) {
				return TRUE;
			}

			/*$sInput  = (!empty($this->aGP['captcha'])) ? $this->aGP['captcha'] : '';
			$bResult = TRUE;

			if (!strlen($sExtKey) || !t3lib_extMgm::isLoaded($sExtKey)) {
				return TRUE;
			}

			// Check captcha
			switch ($sExtKey) {
				case 'sr_freecap' :
					if (!strlen($sInput)) {
						return FALSE;
					}
					t3lib_div::requireOnce(t3lib_extMgm::extPath($sExtKey) . 'pi2/class.tx_srfreecap_pi2.php');
					$oCaptcha = t3lib_div::makeInstance('tx_srfreecap_pi2');
					return $oCaptcha->checkWord($sInput);
					break;
				case 'jm_recaptcha' :
					t3lib_div::requireOnce(t3lib_extMgm::extPath($sExtKey) . 'class.tx_jmrecaptcha.php');
					$oCaptcha  = t3lib_div::makeInstance('tx_jmrecaptcha');
					$aResponse = $oCaptcha->validateReCaptcha();
					return (isset($aResponse['verified']) && (bool) $aResponse['verified']);
					break;
				case 'captcha' :
					session_start();
					$sCaptcha = $_SESSION['tx_captcha_string'];
					return ($sInput === $sCaptcha);
					break;
				case 'mathguard' :
					t3lib_div::requireOnce(t3lib_extMgm::extPath($sExtKey) . 'class.tx_mathguard.php');
					$oCaptcha = t3lib_div::makeInstance('tx_mathguard');
					return $oCaptcha->validateCaptcha();
					break;
				default:
					return FALSE;
			}*/

			return FALSE;
		}

	}
?>
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
	 * Guestbook entry
	 */
	class Tx_SpGuestbook_Domain_Model_Entry extends Tx_Extbase_DomainObject_AbstractEntity {

		/**
		 * Name of the author
		 *
		 * @var string
		 * @validate NotEmpty, StringLength(minimum = 2, maximum = 200)
		 */
		protected $name;

		/**
		 * Email address of the author
		 *
		 * @var string
		 * @validate EmailAddress
		 */
		protected $email;

		/**
		 * URL of a website of the author
		 *
		 * @var string
		 */
		// vali date RegularExpression(regularExpression = '||')
		protected $url;

		/**
		 * City / country / office of the author
		 *
		 * @var string
		 */
		protected $location;

		/**
		 * Content of the entry
		 *
		 * @var string
		 * @validate NotEmpty
		 */
		protected $content;

		/**
		 * Internal note
		 *
		 * @var string
		 */
		protected $note;

		/**
		 * Reference to frontend user
		 *
		 * @var Tx_Extbase_Domain_Model_FrontendUser
		 */
		protected $userId;

		/**
		 * Captcha used to create the entry
		 *
		 * @var string
		 */
		protected $captcha;


		/**
		 * @param string $name
		 * @return void
		 */
		public function setName($name) {
			$this->name = $name;
		}


		/**
		 * @return string
		 */
		public function getName() {
			return $this->name;
		}


		/**
		 * @param string $email
		 * @return void
		 */
		public function setEmail($email) {
			$this->email = $email;
		}


		/**
		 * @return string
		 */
		public function getEmail() {
			return $this->email;
		}


		/**
		 * @param string $url
		 * @return void
		 */
		public function setUrl($url) {
			$this->url = $url;
		}


		/**
		 * @return string
		 */
		public function getUrl() {
			return $this->url;
		}


		/**
		 * @param string $location
		 * @return void
		 */
		public function setLocation($location) {
			$this->location = $location;
		}


		/**
		 * @return string
		 */
		public function getLocation() {
			return $this->location;
		}


		/**
		 * @param string $content
		 * @return void
		 */
		public function setContent($content) {
			$this->content = $content;
		}


		/**
		 * @return string
		 */
		public function getContent() {
			return $this->content;
		}


		/**
		 * @param string $note
		 * @return void
		 */
		public function setNote($note) {
			$this->note = $note;
		}


		/**
		 * @return string
		 */
		public function getNote() {
			return $this->note;
		}


		/**
		 * @param Tx_Extbase_Domain_Model_FrontendUser $userId
		 * @return void
		 */
		public function setUserId(Tx_Extbase_Domain_Model_FrontendUser $userId) {
			$this->userId = $userId;
		}


		/**
		 * @return Tx_Extbase_Domain_Model_FrontendUser
		 */
		public function getUserId() {
			return $this->userId;
		}


		/**
		 * @param string $captcha
		 * @return void
		 */
		public function setCaptcha($captcha) {
			$this->captcha = $captcha;
		}


		/**
		 * @return string
		 */
		public function getCaptcha() {
			return $this->captcha;
		}

	}
?>
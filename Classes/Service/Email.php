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
	 * Service for emails
	 */
	class Tx_SpGuestbook_Service_Email implements t3lib_Singleton {

		/**
		 * @var Tx_Extbase_Configuration_ConfigurationManager
		 */
		protected $configurationManager;

		/**
		 * @var Tx_Extbase_Object_ObjectManager
		 */
		protected $objectManager;

		/**
		 * @var tslib_cObj
		 */
		protected $contentObject;

		/**
		 * @var array
		 */
		protected $configuration;

		/**
		 * @var string
		 */
		protected $templateName;

		/**
		 * @var string
		 */
		protected $templateVariables;

		/**
		 * @var string
		 */
		protected $recipients;

		/**
		 * @var string
		 */
		protected $sender;

		/**
		 * @var string
		 */
		protected $replyTo;

		/**
		 * @var string
		 */
		protected $returnPath;

		/**
		 * @var string
		 */
		protected $emailFormat = 'html';

		/**
		 * @var string
		 */
		protected $templateSchema = 'Email/@name.@format';


		/**
		 * @param Tx_Extbase_Object_ObjectManager $objectManager
		 * @return void
		 */
		public function injectObjectManager(Tx_Extbase_Object_ObjectManager $objectManager) {
			$this->objectManager = $objectManager;
		}


		/**
		 * @param Tx_Extbase_Configuration_ConfigurationManager $configurationManager
		 * @return void
		 */
		public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $configurationManager) {
			$this->configurationManager = $configurationManager;
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
		 * Set template name
		 *
		 * @param string $templateName Name of the email template
		 * @return void
		 */
		public function setTemplateName($templateName) {
			$this->templateName = $templateName;
		}


		/**
		 * Set template variables
		 *
		 * @param string $variables Template variables
		 * @return void
		 */
		public function setTemplateVariables($templateVariables) {
			$this->templateVariables = $templateVariables;
		}


		/**
		 * Set recipients
		 *
		 * @param string $recipients List of recipients
		 * @return void
		 */
		public function setRecipients($recipients) {
			$this->recipients = $recipients;
		}


		/**
		 * Set sender address
		 *
		 * @param string $sender Email sender
		 * @return void
		 */
		public function setSender($sender) {
			$this->sender = $sender;
		}


		/**
		 * Set reply to address
		 *
		 * @param string $replyTo Reply to address
		 * @return void
		 */
		public function setReplyTo($replyTo) {
			$this->replyTo = $replyTo;
		}


		/**
		 * Set return path address
		 *
		 * @param string $returnPath Return path email address
		 * @return void
		 */
		public function setReturnPath($returnPath) {
			$this->returnPath = $returnPath;
		}


		/**
		 * Set email format
		 *
		 * @param string $emailFormat Email format
		 * @return void
		 */
		public function setEmailFormat($emailFormat) {
			if ($emailFormat === 'html' || $emailFormat === 'plain') {
				$this->emailFormat = $emailFormat;
			}
		}


		/**
		 * Send a template based email
		 *
		 * @param string $recipients List of recipients
		 * @param string $subject Email subject
		 * @param string $templateName Name of the email template
		 * @param array $variables Template variables
		 * @param string $sender Email sender
		 * @param string $replyTo Reply to this address
		 * @param string $returnPath Return path
		 * @param array $attachments Attachement files
		 * @return boolean TRUE on success
		 */
		public function sendMail($recipients, $subject, $templateName = '', array $variables = array(), $sender = '', $replyTo = '', $returnPath = '', array $attachments = array()) {
				// Build email
			$email = t3lib_div::makeInstance('t3lib_mail_Message');
			$email->setSubject($subject);
			$email->setTo(t3lib_div::trimExplode(',', $recipients));

				// Add sender
			$sender = (!empty($sender) ? $sender : $this->sender);
			$sender = (!empty($sender) ? $sender : 'webmaster@' . $_SERVER['SERVER_ADDR']);
			$email->setFrom($sender);

				// Add reply to
			$replyTo = (!empty($replyTo) ? $replyTo : $this->replyTo);
			$replyTo = (!empty($replyTo) ? $replyTo : $sender);
			$email->setReplyTo($replyTo);

				// Add return path
			$returnPath = (!empty($returnPath) ? $returnPath : $this->returnPath);
			$returnPath = (!empty($returnPath) ? $returnPath : $sender);
			$email->setReturnPath($returnPath);

				// Add content
			$content = $this->renderTemplate($templateName, $variables);
			$email->setBody($content, 'text/' . $this->emailFormat);

				// Add attachements
			if (!empty($attachments)) {
				foreach ($attachments as $attachment) {
					$email->attach($attachment);
				}
			}

				// Send email
			$email->send();
			return $email->isSent();
		}


		/**
		 * Renders given template
		 *
		 * @param string $name Name of the template
		 * @param array $variables Template variables
		 * @return string Rendered template
		 */
		protected function renderTemplate($name = '', array $variables = array()) {
			$name = (!empty($name) ? $name : $this->templateName);
			if (empty($name)) {
				return '';
			}

				// Get configuration
			if (empty($this->configuration)) {
				$this->configuration = $this->configurationManager->getConfiguration(
					Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
				);
			}

				// Get template file name
			$rootPath = t3lib_div::getFileAbsFileName($this->configuration['view']['templateRootPath']);
			$format   = ($this->emailFormat === 'html' ? 'html' : 'txt');
			$filename = str_replace(array('@name', '@format'), array(ucfirst($name), $format), $this->templateSchema);

				// Get view
			$view = $this->objectManager->get('Tx_Fluid_View_StandaloneView');
			$view->setFormat($format);
			$view->setTemplatePathAndFilename($rootPath . $filename);

				// Set extension name
			$extensionName = $this->request->getControllerExtensionName();
			$view->getRequest()->setControllerExtensionName($extensionName);

				// Add variables
			$variables = (!empty($variables) ? $variables : $this->variables);
			if (!empty($variables)) {
				$view->assignMultiple($variables);
			}

				// Render template
			$content = $view->render();
			unset($view);

			return $content;
		}

	}
?>
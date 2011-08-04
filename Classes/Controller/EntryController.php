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
	 * Controller for the Gallery object
	 */
	class Tx_SpGuestbook_Controller_EntryController extends Tx_Extbase_MVC_Controller_ActionController {

		/**
		 * @var Tx_SpGuestbook_Domain_Repository_EntryRepository
		 */
		protected $entryRepository;

		/**
		 * @var array
		 */
		protected $plugin;

		/**
		 * @var array
		 */
		protected $ids;


		/**
		 * @param Tx_SpGuestbook_Domain_Repository_EntryRepository $entryRepository
		 * @return void
		 */
		public function injectEntryRepository(Tx_SpGuestbook_Domain_Repository_EntryRepository $entryRepository) {
			$this->entryRepository = $entryRepository;
		}


		/**
		 * Initializes the current action
		 *
		 * @return void
		 */
		protected function initializeAction() {
				// Pre-parse TypoScript setup
			$this->settings = Tx_SpGuestbook_Utility_TypoScript::parse($this->settings);

				// Get information about current plugin
			$contentObject = $this->configurationManager->getContentObject();
			$this->plugin = (!empty($contentObject->data) ? $contentObject->data : array());

				// Get UIDs and PIDs of the configured gallaries
			if (empty($this->settings['pages'])) {
				$this->flashMessageContainer->add('Extension sp_guestbook: No entries defined to show');
			}
			$this->ids = $this->getIds($this->settings['pages']);
		}


		/**
		 * Displays all entries
		 *
		 * @param integer $limit Limit count of results
		 * @return void
		 */
		public function listAction($limit = 0) {
			if (empty($this->ids['uids']) && empty($this->ids['pids'])) {
				$this->flashMessageContainer->add('Extension sp_guestbook: No storagePid defined');
			}

			$uids     = (!empty($this->ids['uids']) ? $this->ids['uids'] : array(0));
			$pids     = (!empty($this->ids['pids']) ? $this->ids['pids'] : array(0));
			$ordering = $this->getOrdering();
			$entries  = $this->entryRepository->findByUidsAndPids($uids, $pids, $limit, $ordering);

			$this->view->assign('entries',    $entries);
			$this->view->assign('settings',   $this->settings);
			$this->view->assign('plugin',     $this->plugin);
		}


		/**
		 * Displays a limited count of entries for a teaser
		 *
		 * @return void
		 */
		public function teaserAction() {
			$limit = (!empty($this->settings['teaserCount']) ? $this->settings['teaserCount'] : 3);
			$this->listAction((int) $limit);
			$this->view->assign('listPage', $this->getPageId('listPage'));
		}


		/**
		 * Displays a form for creating a new entry
		 *
		 * @param Tx_SpGuestbook_Domain_Model_Entry $newEntry Entry object which has not yet been added to the repository
		 * @return void
		 * @dontvalidate $newEntry
		 */
		public function newAction(Tx_SpGuestbook_Domain_Model_Entry $newEntry = NULL) {
			$this->view->assign('newEntry', $newEntry);
			Tx_Extbase_Utility_Cache::clearPageCache();
		}


		/**
		 * Creates a new entry and forwards to the list action
		 *
		 * @param Tx_SpGuestbook_Domain_Model_Entry $newEntry Entry object which has not yet been added to the repository
		 * @return void
		 */
		public function createAction(Tx_SpGuestbook_Domain_Model_Entry $newEntry) {
				// Set pid manually to configured storage page
			$newEntry->setPid($this->getStoragePageId());

				// Add new record
			$this->entryRepository->add($newEntry);
			$this->flashMessageContainer->add('Extension sp_guestbook: New entry was created');

				// Clear list page cache and redirect to it
			$page = $this->getPageId('listPage');
			Tx_Extbase_Utility_Cache::clearPageCache($page);
			$this->redirect('list', NULL, NULL, NULL, (!empty($page) ? $page : NULL));
		}


		/**
		 * Returns an array of PIDs and UIDs
		 *
		 * @param string $pages List of pages
		 * @return array UIDs and PIDs
		 */
		protected function getIds($pages) {
			$ids = array(
				'uids' => array(),
				'pids' => array(),
			);

			$pages = t3lib_div::trimExplode(',', $pages);
			foreach($pages as $page) {
				$id  = substr($page, strrpos($page, '_') + 1);
				$key = (strpos($page, 'pages') !== FALSE ? 'pids' : 'uids');
				$ids[$key][] = (int)$id;
			}

			return $ids;
		}


		/**
		 * Returns the ordering of repository result
		 *
		 * @return array Ordering
		 */
		protected function getOrdering() {
			$orderMap = array(
				'ASC'  => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
				'DESC' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
			);

			$field    = (!empty($this->settings['orderingField']) ? $this->settings['orderingField'] : 'crdate');
			$ordering = $orderMap['DESC'];

			if (!empty($this->settings['ordering']) && !empty($orderMap[strtoupper($this->settings['ordering'])])) {
				$ordering = $orderMap[strtoupper($this->settings['ordering'])];
			}

			return array($field => $ordering);
		}


		/**
		 * Returns the ID of configured page
		 *
		 * @param string $settingName Name of the page in settings
		 * @return integer PID of the page
		 */
		protected function getPageId($settingName) {
			if (!empty($settingName) && !empty($this->settings[$settingName])) {
				return (int) str_replace('pages_', '', $this->settings[$settingName]);
			}

			return 0;
		}


		/**
		 * Returns the storage page of new guestbook entries
		 *
		 * @return interger PID of the storage page
		 */
		protected function getStoragePageId() {
				// Get full configuration
			$frameworkConfiguration = $this->configurationManager->getConfiguration(
				Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
			);
			$pluginConfiguration = Tx_SpGuestbook_Utility_TypoScript::getSetup('plugin.tx_spguestbook');
			$pluginConfiguration = Tx_SpGuestbook_Utility_TypoScript::parse($pluginConfiguration);
			$configuration = Tx_Extbase_Utility_Arrays::arrayMergeRecursiveOverrule(
				$frameworkConfiguration, $pluginConfiguration, FALSE, FALSE
			);

				// Find first appropriate value
			switch (TRUE) {
				case (!empty($this->ids['pids']) && is_array($this->ids['pids'])) :
					$storagePageIds = $this->ids['pids'];
					break;
				case (!empty($configuration['persistence']['newRecordStoragePid'])) :
					$storagePageIds = t3lib_div::intExplode(',', $configuration['persistence']['newRecordStoragePid']);
					break;
				case (!empty($configuration['persistence']['storagePid'])) :
					$storagePageIds = t3lib_div::intExplode(',', $configuration['persistence']['storagePid']);
					break;
				default :
					$storagePageIds = array($GLOBALS['TSFE']->id);
			}

			return (int) reset($storagePageIds);
		}

	}
?>
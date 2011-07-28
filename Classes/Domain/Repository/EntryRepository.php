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
	 * Repository for Tx_SpGuestbook_Domain_Model_Entry
	 */
	class Tx_SpGuestbook_Domain_Repository_EntryRepository extends Tx_Extbase_Persistence_Repository {

		/**
		 * Finds a given count of entries
		 *
		 * @param array $uids UIDs to collect objects from
		 * @param array $pids PIDs to collect objects from
		 * @param integer $limit Limit count of results
		 * @param array $orderings Orderings of the result
		 * @return array An array of objects, empty if no objects found
		 */
		public function findByUidsAndPids(array $uids, array $pids, $limit = 0, array $orderings = array()) {
			$query = $this->createQuery();

				// Disable default storage page handling
			$query->getQuerySettings()->setRespectStoragePage(FALSE);

				// UIDs and PIDs
			if (!empty($uids) && !empty($pids)) {
				$query->matching(
					$query->logicalOr(
						$query->in('uid', $uids),
						$query->in('pid', $pids)
					)
				);
			} else if (!empty($uids)) {
				$query->matching($query->in('uid', $uids));
			} else if (!empty($pids)) {
				$query->matching($query->in('pid', $pids));
			} else {
				throw new Exception('Extension sp_guestbook: No UIDs and PIDs given to find guestbook entries', 1308305569);
			}

				// Limit
			if (!empty($limit)) {
				$query->setLimit((int) $limit);
			}

				// Ordering
			if (!empty($orderings)) {
				$query->setOrderings($orderings);
			}

			return $query->execute();
		}

	}
?>
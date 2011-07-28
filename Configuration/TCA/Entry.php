<?php
	if (!defined ('TYPO3_MODE')) {
		die ('Access denied.');
	}

	$TCA['tx_spguestbook_domain_model_entry'] = array(
		'ctrl'      => $TCA['tx_spguestbook_domain_model_entry']['ctrl'],
		'interface' => array(
			'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, email, url, location, content, note',
		),
		'types' => array(
			'1'     => array(
				'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, email, url, location, content;;2;richtext:rte_transform[flag=rte_enabled|mode=ts];4-4-4, note,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime',
			),
		),
		'palettes' => array(
			'1'        => array(
				'showitem' => '',
			),
		),
		'columns' => array(
			'sys_language_uid' => array(
				'exclude'          => 1,
				'label'            => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
				'config'           => array(
					'type'                => 'select',
					'foreign_table'       => 'sys_language',
					'foreign_table_where' => 'ORDER BY sys_language.title',
					'items'               => array(
						array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
						array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0),
					),
				),
			),
			'l10n_parent' => array(
				'displayCond' => 'FIELD:sys_language_uid:>:0',
				'exclude'     => 1,
				'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
				'config'      => array(
					'type'        => 'select',
					'foreign_table'       => 'tx_spguestbook_domain_model_entry',
					'foreign_table_where' => 'AND tx_spguestbook_domain_model_entry.pid=###CURRENT_PID### AND tx_spguestbook_domain_model_entry.sys_language_uid IN (-1,0)',
					'items'               => array(
						array('', 0),
					),
				),
			),
			'l10n_diffsource' => array(
				'config'          => array(
					'type'            => 'passthrough',
				),
			),
			't3ver_label' => array(
				'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
				'config'      => array(
					'type'        => 'input',
					'size'        => 30,
					'max'         => 255,
				)
			),
			'hidden' => array(
				'exclude' => 1,
				'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
				'config'  => array(
					'type'    => 'check',
				),
			),
			'starttime' => array(
				'exclude'   => 1,
				'l10n_mode' => 'mergeIfNotBlank',
				'label'     => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
				'config'    => array(
					'type'      => 'input',
					'size'      => 13,
					'max'       => 20,
					'eval'      => 'datetime',
					'checkbox'  => 0,
					'default'   => 0,
					'range'     => array(
						'lower'     => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
					),
				),
			),
			'endtime' => array(
				'exclude'   => 1,
				'l10n_mode' => 'mergeIfNotBlank',
				'label'     => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
				'config'    => array(
					'type'      => 'input',
					'size'      => 13,
					'max'       => 20,
					'eval'      => 'datetime',
					'checkbox'  => 0,
					'default'   => 0,
					'range'     => array(
						'lower'     => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
					),
				),
			),
			'name' => array(
				'exclude' => 0,
				'label'   => 'LLL:EXT:sp_guestbook/Resources/Private/Language/locallang_db.xml:tx_spguestbook_domain_model_entry.name',
				'config'  => array(
					'type'    => 'input',
					'size'    => 30,
					'eval'    => 'trim,required',
				),
			),
			'email' => array(
				'exclude' => 0,
				'label'   => 'LLL:EXT:sp_guestbook/Resources/Private/Language/locallang_db.xml:tx_spguestbook_domain_model_entry.email',
				'config'  => array(
					'type'    => 'input',
					'size'    => 30,
					'eval'    => 'trim',
				),
			),
			'url' => array(
				'exclude' => 0,
				'label'   => 'LLL:EXT:sp_guestbook/Resources/Private/Language/locallang_db.xml:tx_spguestbook_domain_model_entry.url',
				'config'  => array(
					'type'    => 'input',
					'size'    => 30,
					'eval'    => 'trim',
				),
			),
			'location' => array(
				'exclude' => 0,
				'label'   => 'LLL:EXT:sp_guestbook/Resources/Private/Language/locallang_db.xml:tx_spguestbook_domain_model_entry.location',
				'config'  => array(
					'type'    => 'input',
					'size'    => 30,
					'eval'    => 'trim',
				),
			),
			'content' => array(
				'exclude'     => 1,
				'label'       => 'LLL:EXT:sp_guestbook/Resources/Private/Language/locallang_db.xml:tx_spguestbook_domain_model_entry.content',
				'config'      => array(
					'type'        => 'text',
					'cols'        => 32,
					'rows'        => 5,
					'eval'        => 'required',
				),
			),
			'note' => array(
				'exclude'     => 1,
				'label'       => 'LLL:EXT:sp_guestbook/Resources/Private/Language/locallang_db.xml:tx_spguestbook_domain_model_entry.note',
				'config'      => array(
					'type'        => 'text',
					'cols'        => 32,
					'rows'        => 5,
					'eval'        => 'required',
				),
			),
			'user_id' => array(
				'config' => array(
					'type' => 'passthrough',
				),
			),
		),
	);
?>
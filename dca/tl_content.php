<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2012
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @author     Jan Reuteler <jan.reuteler@iserv.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['training_dates'] = '{type_legend},type,headline;{config_legend},training_dates_courseId,training_jumpTo;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['training_dates_courseId'] = array
(
	'label'                  	=> &$GLOBALS['TL_LANG']['tl_content']['training_dates_courseId'],
	'exclude'               	=> true,
	'inputType'               	=> 'select',
	'foreignKey'              	=> 'tl_training_course.name',
	'eval'                    	=> array('mandatory'=>true, 'chosen'=>true)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['training_jumpTo'] = array
(
	'label'                  	=> &$GLOBALS['TL_LANG']['tl_content']['training_jumpTo'],
	'exclude'               	=> true,
	'inputType'               	=> 'pageTree',
	'eval'                    	=> array('mandatory'=>true, 'fieldType'=>'radio'),
);


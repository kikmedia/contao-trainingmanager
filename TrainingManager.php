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


class TrainingManager extends System 
{
	public function allCourses($intCourse = null) 
	{
		return $this->getCourseDates(false, $intCourse);
	}
	
	public function availableCourses($intCourse = null) 
	{
		return $this->getCourseDates(true, $intCourse); 
	}
	
	protected function getCourseDates($blnAvailable, $intCourse = null) 
	{
		$time = time();
		$arrDates = array();
		$this->import('Database');
		$objDates = $this->Database->prepare("SELECT 
		tc.*, td.*, 
		(SELECT count(*) FROM tl_training_participant WHERE pid=(SELECT id FROM tl_training_registration WHERE pid=td.id) ) as participantCount
		FROM tl_training_date td
		
		
		LEFT JOIN
		tl_training_course tc ON td.pid=tc.id
		
		WHERE 
		td.startDate >= $time AND 
		td.timeForApplication >= $time 
		" . (BE_USER_LOGGED_IN ? '' : " AND published='1'") . " 		
		" . ( $intCourse != null ? " AND tc.id=$intCourse " : '') . "
		
		
		HAVING participantCount<tc.maxParticipants
		
		ORDER BY td.startDate")
		->execute();
				
				
		while ($objDates->next()) 
		{
			$arrDates[] = array_merge($objDates->row(), array
			(
				'available'				=> ($objDates->maxParticipants - $objDates->participantCount),
				'location' 				=> 'Z�rich-Kloten', 
				'formattedStartDate'	=> $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objDates->startDate),  
				'formattedEndDate'		=> $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $objDates->endDate),  
			));
		}
		
		return $arrDates;
	}
		
}
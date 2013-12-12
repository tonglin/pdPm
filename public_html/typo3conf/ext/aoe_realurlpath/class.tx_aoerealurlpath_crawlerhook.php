<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2005 Kasper Sk�rh�j
 *  All rights reserved
 *
 *  This script is part of the Typo3 project. The Typo3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 *
 * @author	Daniel Poetzinger
 */

include_once (t3lib_extMgm::extPath('aoe_realurlpath') . 'class.tx_aoerealurlpath_cachemgmt.php');
/**
 *
 * @author	Daniel Poetzinger
 * @package realurl
 * @subpackage aoe_realurlpath
 */
class tx_aoerealurlpath_crawlerhook
{
/**
	 * Publishes the current page as static HTML file if possible (depends on configuration and other circumstances)
	 * (Hook-function called from TSFE, see ext_localconf.php for configuration)
	 *
	 * @param	object		Reference to parent object (TSFE)
	 * @param	integer		[Not used here]
	 * @return	void
	 */
	function insertPageIncache(&$pObj,$timeOutTime)	{

		
			// Look for "crawler" extension activity:
			// Requirements are that the crawler is loaded, a crawler session is running and tx_cachemgm_recache requested as processing instruction:
		if (t3lib_extMgm::isLoaded('crawler')
				&& $pObj->applicationData['tx_crawler']['running']
				&& in_array('tx_cachemgm_recache', $pObj->applicationData['tx_crawler']['parameters']['procInstructions']))	{

				
				$lconf = array ();
				$lconf ['parameter'] = $GLOBALS['TSFE']->id;
				$lconf ['returnLast'] = 'url';
				//flush realurl cache for this page:
				$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_realurl_urlencodecache', 'page_id='.intval($GLOBALS['TSFE']->id));
				$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_realurl_urldecodecache', 'page_id='.intval($GLOBALS['TSFE']->id));
				$GLOBALS['TSFE']->applicationData['tx_realurl']['_CACHE']=array();
				$loginfos='(lang: '.$GLOBALS['TSFE']->sys_language_uid.' langc:'.$GLOBALS['TSFE']->sys_language_content.')';
				$pObj->applicationData['aoe_realurlpath']['crawlermode']=TRUE;
				$pObj->applicationData['tx_crawler']['log'][]='force linkgeneration: '.$GLOBALS['TSFE']->cObj->typolink( 'test', $lconf ).$loginfos;
		        $pObj->applicationData['aoe_realurlpath']['crawlermode']=FALSE;
		} 
	}
}

	
?>

<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2007 Kasper Ligaard (ligaard@daimi.au.dk)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
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
 ***************************************************************/
/**
 * Test case for checking the PHPUnit 3.1.9
 *
 * WARNING: Never ever run a unit test like this on a live site!
 *
 *
 * @author	Daniel P�tzinger
 */
require_once (t3lib_extMgm::extPath("aoe_realurlpath") . 'class.tx_aoerealurlpath_cachemgmt.php');
// require_once (t3lib_extMgm::extPath('phpunit').'class.tx_phpunit_test.php');
require_once (PATH_t3lib . 'class.t3lib_tcemain.php');
class tx_aoerealurlpath_cachemgmt_testcase extends tx_phpunit_testcase
{
    public function test_storeInCache ()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->setCacheTimeOut(200);
        $cache->setRootPid(1);
        $path = $cache->storeUniqueInCache('9999', 'test9999');
        $this->assertEquals('test9999', $cache->isInCache(9999), 'should be in cache');
        $cache->_delCacheForPid(9999);
        $this->assertFalse($cache->isInCache(9999), 'should not be in cache');
    }
    public function test_storeEmptyInCache ()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->clearAllCache();
        $cache->setCacheTimeOut(200);
        $cache->setRootPid(1);
        $path = $cache->storeUniqueInCache('9995', '');
        $this->assertEquals('', $path, 'should be empty path');
        $this->assertEquals('', $cache->isInCache(9995), 'should be in cache');
        $path = $cache->storeUniqueInCache('9995', '');
        $this->assertEquals('', $path, 'should be empty path');
        $this->assertEquals('', $cache->isInCache(9995), 'should be in cache');
        $cache->_delCacheForPid(9995);
        $this->assertFalse($cache->isInCache(9995), 'should not be in cache');
    }
    public function test_getEmptyFromCache ()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->clearAllCache();
        $cache->setCacheTimeOut(200);
        $cache->setRootPid(1);
        $path = $cache->storeUniqueInCache('9995', '');
        $pidOrFalse = $cache->checkCacheWithDecreasingPath(array(''), $dummy);
        $this->assertEquals($pidOrFalse, 9995, 'should be in cache');
    }
    public function test_storeInCacheCollision ()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->setCacheTimeOut(200);
        $cache->setRootPid(1);
        $path = $cache->storeUniqueInCache('9999', 'test9999');
        $this->assertEquals('test9999', $cache->isInCache(9999), 'should be in cache');
        $path = $cache->storeUniqueInCache('9998', 'test9999');
        $this->assertEquals('test9999_9998', $cache->isInCache(9998), 'should be in cache');
    }
    public function test_storeInCacheWithoutCollision ()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->clearAllCache();
        $cache->setCacheTimeOut(200);
        $cache->setRootPid(1);
        $path = $cache->storeUniqueInCache('9990', 'sample');
        $this->assertEquals('sample', $cache->isInCache(9990), 'sample should be in cache');
        //store same page in another workspace
        $cache->workspaceId = 2;
        $path = $cache->storeUniqueInCache('9990', 'sample');
        $this->assertEquals('sample', $cache->isInCache(9990), 'sample should be in cache for workspace=2');
        //store same page in another workspace
        $cache->workspaceId = 3;
        $path = $cache->storeUniqueInCache('9990', 'sample');
        $this->assertEquals('sample', $cache->isInCache(9990), 'should be in cache for workspace=3');
        //and in another language also
        $cache->languageId = 1;
        $path = $cache->storeUniqueInCache('9990', 'sample');
        $this->assertEquals('sample', $cache->isInCache(9990), 'should be in cache for workspace=3 and language=1');
    }
    public function test_pathRetrieval ()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->clearAllCache();
        $cache->setCacheTimeOut(200);
        $cache->setRootPid(1);
        $cache->storeUniqueInCache('9990', 'sample/path1');
        $cache->storeUniqueInCache('9991', 'sample/path1/path2');
        $cache->storeUniqueInCache('9992', 'sample/newpath1/path3');
        $dummy = array();
        $pidOrFalse = $cache->checkCacheWithDecreasingPath(array('sample' , 'path1'), $dummy);
        $this->assertEquals($pidOrFalse, '9990', '9990 should be fould for path');
        $dummy = array();
        $pidOrFalse = $cache->checkCacheWithDecreasingPath(array('sample' , 'path1' , 'nothing'), $dummy);
        $this->assertEquals($pidOrFalse, '9990', '9990 should be fould for path');
        $dummy = array();
        $pidOrFalse = $cache->checkCacheWithDecreasingPath(array('sample' , 'path2'), $dummy);
        $this->assertEquals($pidOrFalse, FALSE, ' should not be fould for path');
    }
    public function test_canDetectRowAsInvalid()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->setCacheTimeOut(1);
        $this->assertFalse($cache->_isCacheRowStillValid(array('dirty'=>'1'),FALSE),'should return false');
        $this->assertFalse($cache->_isCacheRowStillValid(array('tstamp'=>(time()-2)),FALSE),'should return false');
    }    
 	public function test_canStoreAndGetFromHistory()
    {
        $cache = new tx_aoerealurlpath_cachemgmt(0, 0);
        $cache->clearAllCache();
        $cache->setCacheTimeOut(1);
        $cache->setRootPid(1);
        $cache->storeUniqueInCache('9990', 'sample/path1');
       
        $dummy = array();
        $pidOrFalse = $cache->checkCacheWithDecreasingPath(array('sample' , 'path1'), $dummy);
        $this->assertEquals($pidOrFalse, '9990', '9990 should be fould for path');
        
        sleep(2);
        
        $dummy = array();
        $pidOrFalse = $cache->checkCacheWithDecreasingPath(array('sample' , 'path1'), $dummy);
        $this->assertEquals($cache->isInCache(9990), FALSE, 'cache should be expired');

        $cache->storeUniqueInCache('9990', 'sample/path1new');
        $dummy = array();
        $pidOrFalse = $cache->checkCacheWithDecreasingPath(array('sample' , 'path1new'), $dummy);
        $this->assertEquals($pidOrFalse, '9990', ' 9990 should be the path');
        //now check history
        
        $pidOrFalse = $cache->checkHistoryCacheWithDecreasingPath(array('sample' , 'path1'), $dummy);
        $this->assertEquals($pidOrFalse, '9990', ' 9990 should be the pid in history');
        
    }
}
?>
<?php
namespace Heilmann\JhBrowscap\Task;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015-2016 Jonathan Heilmann <mail@jonathan-heilmann.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Heilmann\JhBrowscap\Contrib\Browscap;

/**
 * Class UpdateBrowscapIni
 * @package Heilmann\JhBrowscap\Task
 */
class UpdateBrowscapIni extends \TYPO3\CMS\Scheduler\Task\AbstractTask
{

    /**
     * @var string
     */
    protected $cachePath = 'typo3temp/tx_jhbrowscap/';

    /**
     *
     * @return boolean
     */
    public function execute()
    {
        $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jh_browscap']);

        if (isset($extConf['cachePath']) && preg_match('/^typo3temp\//', $extConf['cachePath']))
            $this->cachePath = rtrim($extConf['cachePath'], '/');
        
        if (!is_dir(PATH_site . $this->cachePath))
            GeneralUtility::mkdir_deep(PATH_site, $this->cachePath);

        /** @var Browscap $browscap */
        $browscap = new Browscap(PATH_site . $this->cachePath);
        return $browscap->updateCache();
    }
}
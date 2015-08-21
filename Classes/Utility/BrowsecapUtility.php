<?php
namespace Heilmann\JhBrowscap\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Heilmann\JhBrowscap\Contrib\Browscap;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Jonathan Heilmann <mail@jonathan-heilmann.de>
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

/**
 * Class BrowscapUtility
 * @package Heilmann\JhBrowsecap\Utility
 */
class BrowscapUtility {

    /**
     * @var string
     */
    protected $cachePath = 'typo3temp/tx_jhbrowscap/';

    /**
     * getBrowser
     *
     * @param string $user_agent   the user agent string
     * @param bool   $return_array whether return an array or an object
     * 
     * @return \stdClass|array  the object containing the browsers details. Array if
     *                    $return_array is set to true.
     */
    public function getBrowser($user_agent = null, $return_array = false) {
        $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jh_browscap']);

        if (preg_match('/^typo3temp\//', $extConf['cachePath'])) {
            $this->cachePath = rtrim($extConf['cachePath'], '/');
        }
        if (!is_dir(PATH_site . $this->cachePath)) {
            GeneralUtility::mkdir_deep(PATH_site, $this->cachePath);
        }

        $browscap = new Browscap($this->cachePath);
        $browscap->doAutoUpdate = false;
        $info = $browscap->getBrowser($user_agent, $return_array);
        return $info;
    }
}
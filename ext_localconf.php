<?php

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Heilmann\JhBrowscap\Task\UpdateBrowscapIni::class] = array(
    'extension' => $_EXTKEY,
    'title' => 'Update Browscap.ini',
    'description' => 'This task updates your local Browscap.ini',
);
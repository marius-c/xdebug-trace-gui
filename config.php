<?php
/**
 * My config
 * return $config = array(
 *   'path'         => 'C:\workspace\wamp\tmp\\',
 *   'file'         => 'stack.xt', //must be in the path above
 *   'exclude_path' => 'C:\workspace\files\zendproject\\', //string to exclude when printing where the files where called in - can be left empty
 * );
 */
return $config = array(
    'path'         => '', //path to your trace files
    'file'         => 'stack.txt', //trace file name, must be in the path above
    'exclude_path' => '', //string to exclude when printing where the files where called in - can be left empty
);
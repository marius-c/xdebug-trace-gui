<?php
/**
 * My config
 * return $config = array(
 *   'path'         => 'C:\workspace\wamp\tmp\\',
 *   'file'         => 'stack.xt', //must be in the path above
 *   'exclude_path' => 'C:\workspace\files\zendproject\\', //string to exclude when printing where the files where called in - can be left empty
 *   'autocomplete_last_trace_file' => 1, //0 or 1 will try to autocomplete last trace file name from the specified path
 * );
 */
return $config = array(
    'path'         => '', //path to your trace files
    'file'         => '', //trace file name, must be in the path above
    'exclude_path' => '', //string to exclude when printing where the files where called in - can be left empty
    'autocomplete_last_trace_file' => 1, //0 or 1 will try to autocomplete last trace file name from the specified path
);
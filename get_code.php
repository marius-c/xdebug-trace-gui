<?php
error_reporting(E_ALL^E_NOTICE);
function highlight_linenumbers ($page, $hline)
{
    $ret    = "";
    $code   = highlight_file($page, TRUE);
    $ret   .= '<ol style="font-family:monospace">';

    $arr = explode('<br />', $code);
    foreach( $arr as $i => $line )
    {
      if (($hline-1) <> $i)
        $ret .=  '<li style="'.(($i%2 == 0) ? 'background-color:#F8F8F8' : '').'">'.$line ."</li>\r";
      else
        $ret .=  '<li style="background-color:#00FFFF"><span id="highlightedline">'.$line ."</span></li>\r";
    }
    $ret .= '</ol>';
    return $ret;
}

if($_GET['file'])
    echo highlight_linenumbers($_GET['file'], $_GET['hline']);
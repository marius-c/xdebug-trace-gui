# xdebug trace gui
================

Parses an [xdebug trace](http://xdebug.org/docs/execution_trace) file and gives you a way to browse code. Useful for long
trace files

## Installation

Download it and modify `config.php` according to your needs

## Screen
![Screen1 xdebug gui](https://github.com/saklak/xdebug-trace-gui/blob/screenshot/screenshots/screen1.JPG)
![Screen2 xdebug gui](https://github.com/saklak/xdebug-trace-gui/blob/screenshot/screenshots/screen2.JPG)

Tested and works with an 25MB trace file although I recomend 
using `xdebug_start_trace()` and `xdebug_stop_trace()`

For now works only with `trace_format = 1`

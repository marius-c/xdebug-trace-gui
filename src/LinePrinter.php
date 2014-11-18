<?php
class LinePrinter implements ILinePrinter
{
    /**
     * @var int Keeps the deep of the calls
     */
    private $lineNo;

    /**
     * @var string String to exclude when showing where the function was called in
     *             C:/workspace/myproject/bla/file.php becomes /bla/file.php
     *             modify it in config.php - exclude_path
     */
    private static $excludePath;

    public function __construct($excludePath)
    {
        self::$excludePath = $excludePath;
    }

    /**
     * @param $currentLine
     */
    public function printHtmlLine($currentLine)
    {
        $columns     = explode("\t", $currentLine);

        if (!is_numeric($columns[0])) return;

        if ($columns[0] > $this->lineNo) {
            $this->indentOpen();
            $this->lineOpen();
            $this->printFormatedLine($columns, self::$excludePath);
            $this->lineNo = $columns[0];
            return;
        }

        if (($columns[0] < $this->lineNo) && $columns[2] == 1) {
            $this->indentClose();
        }

        if ($columns[2] == 0) {
            $this->lineOpen();
            $this->printFormatedLine($columns, self::$excludePath);
        }
        $this->lineNo = $columns[0];
    }

    /**
     * @param $columns
     * @param $excludePath
     */
    private function printFormatedLine($columns, $excludePath)
    {
        echo $columns[5] . "<br/>";
        echo "<span class='called-in'>Called in <a href='javascript:;' class='code-url' data-toggle='tooltip' data-src='".$columns[8]."' data-line='".$columns[9]."'>" .
                str_replace($excludePath, "", $columns[8]) . ":" . $columns[9] . "</a></span></i><br/>";
        if ($columns[10] > 0) {
            echo "<span class='called-in'>Called with: ";
            //iterate parameters and print their values
            for ($j = 0; $j < $columns[10]; $j++) {
                $first_equal = strpos($columns[11 + $j], "=");
                $param_name  = substr($columns[11 + $j], 0, $first_equal);
                $param_value = substr($columns[11 + $j], $first_equal + 1);
                //php function create problems with params name by not giving their name => value as usual, but the direct value
                if (substr($param_name, 0, 1) != '$') $param_name = '$param';
                echo "<a href='javascript:;' class='code-url call-params' qtip-content='<pre>" . htmlentities($param_value, ENT_QUOTES) . "</pre>'>" . $param_name . "</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            echo "</span>";
        }
        $this->lineClose();
    }

    /**
     *
     */
    private function indentOpen() {
        echo "<li class='list-group-item'><span class='glyphicon glyphicon-chevron-right'></span><ul class='sub-section'>";
    }

    /**
     *
     */
    private function indentClose(){
        echo "</ul></span></li>";
    }

    /**
     *
     */
    private function lineOpen() {
        echo "<li>";
    }

    /**
     *
     */
    private function lineClose() {
        echo "</li>";
    }
}
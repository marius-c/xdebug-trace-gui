<?php
class HeaderPrinter implements IHeaderPrinter
{
    /**
     * Prints the file header
     *
     * @param SplFileObject $file
     */
    public function printHeader(SplFileObject $file)
    {
        echo '<div class="header-part">';
        $i = 0;
        while(!$file->eof()) {
            echo $file->fgets() . "<br/>";

            $i++;
            if ($i> 2) {
                break;
            }
        }
        echo '</div>';
    }
}
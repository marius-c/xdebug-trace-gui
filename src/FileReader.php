<?php
class FileReader
{
    /**
     * @var SplFileObject
     */
    protected $file;

    /**
     * @var LinePrinter Object responsible for line printing
     */
    protected $line;

    public function __construct(SplFileObject $file, LinePrinter $line)
    {
        $this->file = $file;
        $this->line = $line;
    }

    /**
     * Reads file line by line
     */
    public function printLines()
    {
        //$i = 0;
        while(!$this->file->eof()) {
            $this->line->printHtmlLine($this->file->fgets());
            /*$i++;
            if ($i> 300) {
                break;
            } */
        }
    }

    /**
     * @return SplFileObject
     */
    public function getFile()
    {
        return $this->file;
    }
}
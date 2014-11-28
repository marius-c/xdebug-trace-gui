<?php
class Config extends ArrayObject
{
    public function __construct(array $config)
    {
        if ($config['autocomplete_last_trace_file'] == 1) {
            $config['file'] = $this->getLastTraceFile($config['path']);
        }

        parent::__construct($config, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Get last trace file from path
     *
     * @param $path
     * @return string
     */
    private function getLastTraceFile($path)
    {
        $files = glob($path . '*.xt');

        if (empty($files)) throw new UnderflowException("No trace file found in the specified path");

        $file = array_reduce($files, function($carry, $item){
            if (is_null($carry))
                return $item;

            return filemtime($item) > filemtime($carry) ? $item : $carry;
        });

        return substr($file, strlen($path));
    }
}
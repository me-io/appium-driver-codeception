<?php

namespace AppiumCodeceptionCLI\Parser\Helpers;

/**
 * Creates a markdown document based on the parsed documentation
 **/
class TextTable
{
    /** @var int The source path */
    public $maxlen = 200;

    /** @var array The source path */
    private $data = [];

    /** @var array The source path */
    private $header = [];

    /** @var array The source path */
    private $len = [];

    /** @var array The source path */
    private $align = [
        'name' => 'L',
        'type' => 'C',
    ];

    /**
     * @param array $header  The header array [key => label, ...]
     * @param array $content Content
     * @param bool  $align   Alignment optios [key => L|R|C, ...]
     */
    public function __construct($header = null, $content = [], $align = false)
    {
        if ($header) {
            $this->header = $header;
        } elseif ($content) {
            foreach ($content[0] as $key => $value) {
                $this->header[$key] = $key;
            }
        }
        foreach ($this->header as $key => $label) {
            $this->len[$key] = strlen($label);
        }
        if (is_array($align)) {
            $this->setAlgin($align);
        }
        $this->addData($content);
    }

    /**
     * Overwrite the alignment array
     *
     * @param array $align Alignment optios [key => L|R|C, ...]
     */
    public function setAlgin($align)
    {
        $this->align = $align;
    }

    /**
     * Add data to the table
     *
     * @param array $content Content
     *
     * @return \AppiumCodeceptionCLI\Parser\Helpers\TextTable
     */
    public function addData($content)
    {
        foreach ($content as &$row) {
            foreach ($this->header as $key => $value) {
                if (!isset($row[$key])) {
                    $row[$key] = '-';
                } elseif (strlen($row[$key]) > $this->maxlen) {
                    $this->len[$key] = $this->maxlen;
                    $row[$key]       = substr($row[$key], 0, $this->maxlen - 3) . '...';
                } elseif (strlen($row[$key]) > $this->len[$key]) {
                    $this->len[$key] = strlen($row[$key]);
                }
            }
        }
        $this->data = $this->data + $content;

        return $this;
    }

    /**
     * Add a delimiter
     *
     * @return string
     */
    private function renderDelimiter()
    {
        $res = '|';
        foreach ($this->len as $key => $l) {
            $res .= (isset($this->align[$key]) && ($this->align[$key] == 'C' || $this->align[$key] == 'L') ? ':' : ' ')
                    . str_repeat('-', $l)
                    . (isset($this->align[$key]) && ($this->align[$key] == 'C' || $this->align[$key] == 'R') ? ':' : ' ')
                    . '|';
        }

        return $res . "\r\n";
    }

    /**
     * Render a single row
     *
     * @param  array $row
     *
     * @return string
     */
    private function renderRow($row)
    {
        $res = '|';
        foreach ($this->len as $key => $l) {
            $res .= ' ' . $row[$key] . ($l > strlen($row[$key]) ? str_repeat(' ', $l - strlen($row[$key])) : '') . ' |';
        }

        return $res . "\r\n";
    }

    /**
     * Render the table
     *
     * @param  array $content Additional table content
     *
     * @return string
     */
    public function render($content = [])
    {
        $this->addData($content);
        $res = $this->renderRow($this->header)
               . $this->renderDelimiter();
        foreach ($this->data as $row) {
            $res .= $this->renderRow($row);
        }

        return $res;
    }
}

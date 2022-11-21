<?php

namespace Core;

class View
{
    private string $tplPath = '';
    private array $data = [];

    public function __construct()
    {
        $this->tplPath = TPL_DIR;
    }

    /**
     * @param string $tpl
     * @param array $data
     * @return string
     * @throws ViewException
     */
    public function render(string $tpl, array $data = []): string
    {
        $this->data += $data;
        ob_start();
        if (file_exists($this->tplPath . DIRECTORY_SEPARATOR . $tpl . '.phtml')) {
            require_once($this->tplPath . DIRECTORY_SEPARATOR . $tpl . '.phtml');
        } else {
            throw new ViewException($tpl . ' - template not found!');
        }
        return ob_get_clean();
    }

    public function assign(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($varName)
    {
        return $this->data[$varName] ?? null;
    }
}
<?php

namespace Manuel\Domain;

use Manuel\Core\Interfaces\IResponse;

class ResponseHtmlInvoiceTemplate implements IResponse, \Stringable
{
    private array $data;

    public function __toString(): string
    {
        $stringReturn = '<table>';
        foreach ($this->data as $row) {
            $stringReturn .= '<tr><td>' . $row['key'] . '</td><td>' . $row['value'] . '</td></tr>';
        }
        $stringReturn .= '</table>';
        return $stringReturn;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }
}
<?php


namespace App\Models\Commons\Column;


use App\Models\Commons\AbstractColumn;

class Columns extends AbstractColumn
{

    public static function make($text, $attribute = null){

        return new static($text, $attribute);
    }
}

<?php


namespace App\Models\Commons;


use Illuminate\Support\Str;

class AbstractColumn
{
    protected $text;
    protected $attribute;

    /**
     * AbstractColumn constructor.
     * @param $label
     * @param $attribute
     */
    public function __construct($text, $attribute)
    {
        $this->text = $text;
        $this->attribute = $attribute ?? Str::snake(Str::lower($text));
    }
}

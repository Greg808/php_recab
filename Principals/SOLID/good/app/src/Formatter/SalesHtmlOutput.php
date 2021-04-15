<?php


namespace Exercise\Formatter;
//@todo implement this

class SalesHtmlOutput implements SalesOutputInterface
{
    public function output(float $sales)
    {
        return "<h1>Sales: $sales</h1>";
    }
}
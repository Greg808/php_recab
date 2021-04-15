<?php


namespace Exercise\Formatter;
//@todo implement this

class SalesHtmlOutput implements SalesOutputInterface
{
    public function output(float $sales): string
    {
        return "<h1>Sales: $sales</h1>";
    }
}
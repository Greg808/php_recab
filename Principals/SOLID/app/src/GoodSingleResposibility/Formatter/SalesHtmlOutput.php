<?php


namespace Exercise\GoodSingleResposibility\Formatter;

class SalesHtmlOutput implements SalesOutputInterface
{
    public function output(float $sales): string
    {
        return "<h3>Sales: $sales</h3>";
    }
}
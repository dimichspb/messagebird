<?php
namespace dimichspb\messagebird\parsers;

interface ParserInterface
{
    public function parse($body);
}
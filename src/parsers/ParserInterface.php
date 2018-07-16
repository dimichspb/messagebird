<?php
namespace dimichspb\messagebird\parsers;

/**
 * Interface ParserInterface
 * @package dimichspb\messagebird\parsers
 */
interface ParserInterface
{
    /**
     * @param $body
     * @return mixed
     */
    public function parse($body);
}
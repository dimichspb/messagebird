<?php
namespace dimichspb\messagebird\responses;

/**
 * Interface ResponseInterface
 * @package dimichspb\messagebird\responses
 */
interface ResponseInterface
{
    /**
     * @param $body
     * @return mixed
     */
    public function setBody($body);

    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @param $line
     * @return mixed
     */
    public function writeLine($line);
}
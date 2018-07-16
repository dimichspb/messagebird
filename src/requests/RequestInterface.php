<?php
namespace dimichspb\messagebird\requests;

/**
 * Interface RequestInterface
 * @package dimichspb\messagebird\requests
 */
interface RequestInterface
{
    /**
     * @return mixed
     */
    public function getAlias();

    /**
     * @return mixed
     */
    public function getMethod();

    /**
     * @return mixed
     */
    public function getBody();
}
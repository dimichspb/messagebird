<?php
namespace dimichspb\messagebird\adapters;

use dimichspb\messagebird\entities\messages\OutputMessage;

/**
 * Interface ClientAdapterInterface
 * @package dimichspb\messagebird\adapters
 */
interface ClientAdapterInterface
{
    /**
     * @return mixed
     */
    public function getBalance();

    /**
     * @param OutputMessage $message
     * @return mixed
     */
    public function sendMessage(OutputMessage $message);
}
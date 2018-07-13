<?php
namespace dimichspb\messagebird\adapters;

use dimichspb\messagebird\entities\messages\OutputMessage;

interface ClientAdapterInterface
{
    public function getBalance();
    public function sendMessage(OutputMessage $message);
}
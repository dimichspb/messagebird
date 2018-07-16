<?php
namespace dimichspb\messagebird\parsers;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\Text;
use dimichspb\messagebird\exceptions\ParsingException;
use dimichspb\messagebird\helpers\AssertHelper;

class JsonParser implements ParserInterface
{
    public function __construct(Configurator $configurator)
    {

    }

    public function parse($body)
    {
        $array = json_decode($body, true);

        if ($array === false) {
            throw new ParsingException('Error parsing request body');
        }

        return new InputMessage(
            $this->getNumber($array),
            $this->getText($array)
        );
    }

    protected function getNumber(array $array)
    {
        AssertHelper::isKeyExist('number', $array);

        return new Number($array['number']);
    }

    protected function getText(array $array)
    {
        AssertHelper::isKeyExist('text', $array);

        return new Text($array['text']);
    }


}
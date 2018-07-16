<?php
namespace dimichspb\messagebird\parsers;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\Text;
use dimichspb\messagebird\exceptions\ParsingException;
use dimichspb\messagebird\helpers\AssertHelper;

/**
 * Class JsonParser
 * @package dimichspb\messagebird\parsers
 */
class JsonParser implements ParserInterface
{
    /**
     * JsonParser constructor.
     * @param Configurator $configurator
     */
    public function __construct(Configurator $configurator)
    {

    }

    /**
     * @param $body
     * @return InputMessage
     * @throws ParsingException
     */
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

    /**
     * @param array $array
     * @return Number
     */
    protected function getNumber(array $array)
    {
        AssertHelper::isKeyExist('number', $array);

        return new Number($array['number']);
    }

    /**
     * @param array $array
     * @return Text
     */
    protected function getText(array $array)
    {
        AssertHelper::isKeyExist('text', $array);

        return new Text($array['text']);
    }


}
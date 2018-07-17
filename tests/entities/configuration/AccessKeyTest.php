<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:10
 */

namespace dimichspb\messagebird\tests\entities\configuration;

use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\exceptions\AssertionException;

class AccessKeyTest extends \PHPUnit_Framework_TestCase
{
    public function test__constructSuccess()
    {
        $accessKey = new AccessKey('aabbccddeeffaabbccddeeff0');

        $this->assertSame($accessKey->getValue(), 'aabbccddeeffaabbccddeeff0');
    }

    public function test__constructExceptionThrown()
    {
        $this->setExpectedException(AssertionException::class);

        $accessKey = new AccessKey(0);
    }
}

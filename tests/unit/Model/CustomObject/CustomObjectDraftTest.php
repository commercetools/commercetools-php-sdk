<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Model\CustomObject;


use Commercetools\Core\Model\Common\LocalizedString;

class CustomObjectDraftTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Commercetools\Core\Model\CustomObject\CustomObjectDraft',
            CustomObjectDraft::fromArray(
                [
                    'container' => 'test',
                    'key' => 'test-key',
                    'value' => 'test-value'
                ]
            )
        );
    }

    public function getObjectValues()
    {
        return [
            [
                LocalizedString::ofLangAndText('en', 'test'),
                '{"container":"test","key":"test-key","value":{"en":"test"}}'
            ],
            [json_decode('{"key":"value"}'), '{"container":"test","key":"test-key","value":{"key":"value"}}'],
            [['key' => 'value'], '{"container":"test","key":"test-key","value":{"key":"value"}}'],
            [
                ['apple', 'banana', 'citrus'],
                '{"container":"test","key":"test-key","value":["apple","banana","citrus"]}'
            ],
            ['test', '{"container":"test","key":"test-key","value":"test"}'],
            [1, '{"container":"test","key":"test-key","value":1}'],
            [1.3, '{"container":"test","key":"test-key","value":1.3}'],
            [true, '{"container":"test","key":"test-key","value":true}'],
        ];
    }
    /**
     * @dataProvider getObjectValues
     */
    public function testObjectValue($value, $result)
    {
        $draft = CustomObjectDraft::ofContainerKeyAndValue('test', 'test-key', $value);
        $this->assertInstanceOf(
            '\Commercetools\Core\Model\CustomObject\CustomObjectDraft',
            $draft
        );
        $this->assertSame($result, json_encode($draft));
    }
}

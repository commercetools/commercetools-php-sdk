<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Common\Context;

class LocalizedSearchKeywordsTest extends \PHPUnit\Framework\TestCase
{
    public function testMagicGet()
    {
        $collection = LocalizedSearchKeywords::of();
        $collection->setAt('en', new SearchKeywords());

        $this->assertInstanceOf(SearchKeywords::class, $collection->en);
    }

    public function testMagicGetNotSet()
    {
        $context = Context::of();
        $context->setGraceful(true);
        $collection = new LocalizedSearchKeywords([], $context);
        $this->assertInstanceOf(SearchKeywords::class, $collection->en);
        $this->assertSame('', (string)$collection->en);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetNoLocale()
    {
        $collection = LocalizedSearchKeywords::of();
        $collection->get();
    }

    public function testAdd()
    {
        $collection = LocalizedSearchKeywords::of();
        $collection->add(new SearchKeywords());

        $this->assertInstanceOf(SearchKeywords::class, $collection->getAt(0));
    }

    public function testToString()
    {
        $keywords = LocalizedSearchKeywords::fromArray(
            [
                'en' => [
                    ['text' => 'Hello World'],
                    ['text'=>'Lorem ipsum dolor sit amet']
                ],
                'de' => [
                    ['text'=>'Hallo Welt', 'suggestTokenizer' => ['type' => 'whitespace']],
                    [
                        'text'=>'Lorem ipsum dolor sit amet',
                        'suggestTokenizer' => [
                            'type' => 'custom',
                            'inputs' => ['lorem ipsum', 'dolor', 'sit amet']
                        ]
                    ]
                ]
            ],
            Context::of()->setLanguages(['de', 'en'])
        );
        $this->assertSame('Hallo Welt, Lorem ipsum dolor sit amet', (string)$keywords);
    }

    public function testFromArray()
    {
        $keywords = LocalizedSearchKeywords::fromArray(
            [
                'en' => [
                    ['text' => 'Hello World'],
                    ['text'=>'Lorem ipsum dolor sit amet']
                ],
                'de' => [
                    ['text'=>'Hallo Welt', 'suggestTokenizer' => ['type' => 'whitespace']],
                    [
                        'text'=>'Lorem ipsum dolor sit amet',
                        'suggestTokenizer' => [
                            'type' => 'custom',
                            'inputs' => ['lorem ipsum', 'dolor', 'sit amet']
                        ]
                    ]
                ]
            ],
            Context::of()->setLanguages(['de', 'en'])
        );

        $this->assertSame('Hallo Welt', $keywords->get()->getAt(0)->getText());
        $this->assertSame('whitespace', $keywords->get()->getAt(0)->getSuggestTokenizer()->getType());
        $this->assertSame('Hello World', $keywords->en->getAt(0)->getText());
        $this->assertSame('custom', $keywords->de->getAt(1)->getSuggestTokenizer()->getType());
    }

    public function testUnsetIterator()
    {
        $keywords = LocalizedSearchKeywords::fromArray(
            [
                'de' => [
                    ['text'=>'Hallo Welt'],
                ],
                'en' => [
                    ['text' => 'Hello World'],
                ],
            ],
            Context::of()->setLanguages(['de', 'en'])
        );
        unset($keywords['de']);

        $this->assertCount(1, $keywords);
        $keywords->rewind();
        $this->assertSame('en', $keywords->key());
        $this->assertJsonStringEqualsJsonString('{"en": [{"text": "Hello World"}]}', json_encode($keywords));
    }
}

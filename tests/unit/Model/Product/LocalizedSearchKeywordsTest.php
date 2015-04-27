<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Model\Common\Context;

class LocalizedSearchKeywordsTest extends \PHPUnit_Framework_TestCase
{
    public function testMagicGet()
    {
        $collection = new LocalizedSearchKeywords();
        $collection->setAt('en', new SearchKeywords());

        $this->assertInstanceOf('\Sphere\Core\Model\Product\SearchKeywords', $collection->en);
    }

    public function testMagicGetNotSet()
    {
        $context = new Context();
        $context->setGraceful(true);
        $collection = new LocalizedSearchKeywords([], $context);
        $this->assertSame('', $collection->en);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetNoLocale()
    {
        $collection = new LocalizedSearchKeywords();
        $collection->get();
    }

    public function testAdd()
    {
        $collection = new LocalizedSearchKeywords();
        $collection->add(new SearchKeywords());

        $this->assertInstanceOf('\Sphere\Core\Model\Product\SearchKeywords', $collection->getAt(0));
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
}

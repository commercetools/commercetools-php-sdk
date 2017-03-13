<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */
namespace Commercetools\Core\Commons;

use Commercetools\Commons\Helper\PriceFinder;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

class PriceFinderTest extends \PHPUnit\Framework\TestCase
{

    protected function getPrices()
    {
        $prices = [
            [
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 1000
                ]
            ],
            [
                'value' => [
                    'currencyCode' => 'USD',
                    'centAmount' => 2000
                ]
            ],
            [
                'country' => 'DE',
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 3000
                ]
            ],
            [
                'country' => 'AT',
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 4000
                ]
            ],
            [
                'country' => 'DE',
                'value' => [
                    'currencyCode' => 'USD',
                    'centAmount' => 5000
                ]
            ],
            [
                'country' => 'AT',
                'value' => [
                    'currencyCode' => 'USD',
                    'centAmount' => 6000
                ]
            ],
            [
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 7000
                ]
            ],
            [
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 8000
                ]
            ],
            [
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 9000
                ]
            ],
            [
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 10000
                ]
            ],
            [
                'country' => 'DE',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 11000
                ]
            ],
            [
                'country' => 'AT',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 12000
                ]
            ],
            [
                'country' => 'DE',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 13000
                ]
            ],
            [
                'country' => 'AT',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 14000
                ]
            ],
            [
                'country' => 'DE',
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 15000
                ]
            ],
            [
                'country' => 'AT',
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 16000
                ]
            ],
            [
                'country' => 'DE',
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 17000
                ]
            ],
            [
                'country' => 'AT',
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 18000
                ]
            ],
            [
                'country' => 'DE',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-1'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 19000
                ]
            ],
            [
                'country' => 'AT',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-1'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 20000
                ]
            ],
            [
                'country' => 'DE',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-2'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 21000
                ]
            ],
            [
                'country' => 'AT',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-2'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-1'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 22000
                ]
            ],
            [
                'country' => 'DE',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-1'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 23000
                ]
            ],
            [
                'country' => 'AT',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-1'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 24000
                ]
            ],
            [
                'country' => 'DE',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-2'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 25000
                ]
            ],
            [
                'country' => 'AT',
                'channel' => [
                    'typeId' => 'channel',
                    'id' => 'channel-2'
                ],
                'customerGroup' => [
                    'typeId' => 'customer-group',
                    'id' => 'customer-group-2'
                ],
                'value' => [
                    'currencyCode' => 'EUR',
                    'centAmount' => 26000
                ]
            ],
        ];

        shuffle($prices);
        return PriceCollection::fromArray($prices);
    }

    public function priceDataProvider()
    {
        return [
            ['EUR', null, null, null, 1000],
            ['USD', null, null, null, 2000],
            ['EUR', 'DE', null, null, 3000],
            ['EUR', 'AT', null, null, 4000],
            ['USD', 'DE', null, null, 5000],
            ['USD', 'AT', null, null, 6000],
            ['EUR', null, null, 'channel-1', 7000],
            ['EUR', null, null, 'channel-2', 8000],
            ['EUR', null, 'customer-group-1', null, 9000],
            ['EUR', null, 'customer-group-2', null, 10000],
            ['EUR', 'DE', null, 'channel-1', 11000],
            ['EUR', 'AT', null, 'channel-1', 12000],
            ['EUR', 'DE', null, 'channel-2', 13000],
            ['EUR', 'AT', null, 'channel-2', 14000],
            ['EUR', 'DE', 'customer-group-1', null, 15000],
            ['EUR', 'AT', 'customer-group-1', null, 16000],
            ['EUR', 'DE', 'customer-group-2', null, 17000],
            ['EUR', 'AT', 'customer-group-2', null, 18000],
            ['EUR', 'DE', 'customer-group-1', 'channel-1', 19000],
            ['EUR', 'AT', 'customer-group-1', 'channel-1', 20000],
            ['EUR', 'DE', 'customer-group-1', 'channel-2', 21000],
            ['EUR', 'AT', 'customer-group-1', 'channel-2', 22000],
            ['EUR', 'DE', 'customer-group-2', 'channel-1', 23000],
            ['EUR', 'AT', 'customer-group-2', 'channel-1', 24000],
            ['EUR', 'DE', 'customer-group-2', 'channel-2', 25000],
            ['EUR', 'AT', 'customer-group-2', 'channel-2', 26000],
        ];
    }
    /**
     * @dataProvider priceDataProvider
     */
    public function testPriceFinder($currency, $country, $customerGroup, $channel, $result)
    {
        $price = PriceFinder::findPriceFor(
            $this->getPrices(),
            $currency,
            $country,
            is_null($customerGroup) ? null :CustomerGroupReference::ofId($customerGroup),
            is_null($channel) ? null :ChannelReference::ofId($channel)
        );

        $this->assertSame($result, $price->getValue()->getCentAmount());
    }
}

<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * Class TaxCategoryDraft
 * @package Sphere\Core\Model\TaxCategory
 * @method string getName()
 * @method TaxCategoryDraft setName(string $name = null)
 * @method string getDescription()
 * @method TaxCategoryDraft setDescription(string $description = null)
 * @method TaxRateCollection getRates()
 * @method TaxCategoryDraft setRates(TaxRateCollection $rates = null)
 */
class TaxCategoryDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'rates' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxRateCollection'],
        ];
    }

    /**
     * @param string $name
     * @param TaxRateCollection $rates
     * @param Context|callable $context
     */
    public function __construct($name, TaxRateCollection $rates, $context = null)
    {
        $this->setContext($context)
            ->setName($name)
            ->setRates($rates);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static(
            $data['name'],
            TaxRateCollection::fromArray($data['rates']),
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}

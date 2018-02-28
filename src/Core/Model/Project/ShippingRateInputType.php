<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://dev.commercetools.com/http-api-projects-project.html#shippingrateinputtype
 * @method string getType()
 * @method ShippingRateInputType setType(string $type = null)
 */
class ShippingRateInputType extends JsonObject
{
    const INPUT_TYPE = '';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        if (static::INPUT_TYPE != '' && !isset($data[static::TYPE])) {
            $data[static::TYPE] = static::INPUT_TYPE;
        }
        parent::__construct($data, $context);
    }


    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == ShippingRateInputType::class && isset($data[static::TYPE])) {
            $className = static::inputType($data[static::TYPE]);
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }

    protected static function inputType($type)
    {
        $types = [
            CartValueType::INPUT_TYPE => CartValueType::class,
            CartClassificationType::INPUT_TYPE => CartClassificationType::class,
            CartScoreType::INPUT_TYPE => CartScoreType::class,
        ];
        return isset($types[$type]) ? $types[$type] : ShippingRateInputType::class;
    }
}

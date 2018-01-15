<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Message\MessagesConfiguration;
use DateTime;

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
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (get_called_class() == ShippingRateInputType::class && isset($data[static::INPUT_TYPE])) {
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

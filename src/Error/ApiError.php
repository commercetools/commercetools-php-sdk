<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method ApiError setCode(string $code = null)
 * @method string getMessage()
 * @method ApiError setMessage(string $message = null)
 */
class ApiError extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'code' => [static::TYPE => 'string'],
            'message' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        if (isset($data['code'])) {
            $className = '\Commercetools\Core\Error\\' . ucfirst($data['code']) . 'Error';
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }
}

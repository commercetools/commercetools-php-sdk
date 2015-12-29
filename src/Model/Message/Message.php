<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Message
 * @method string getId()
 * @method Message setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Message setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method Message setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method Message setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method Message setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method Message setType(string $type = null)
 */
class Message extends JsonObject
{
    const MESSAGE_TYPE = '';

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $type = static::MESSAGE_TYPE;
        if (!empty($type)) {
            $this->setType(static::MESSAGE_TYPE);
        }
    }

    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'sequenceNumber' => [static::TYPE => 'int'],
            'resource' => [static::TYPE => '\Commercetools\Core\Model\Common\Reference'],
            'resourceVersion' => [static::TYPE => 'int'],
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
        if (isset($data['type'])) {
            $className = '\Commercetools\Core\Model\Message\\' . ucfirst($data['type']) . 'Message';
            if (class_exists($className)) {
                return new $className($data, $context);
            }
        }
        return new static($data, $context);
    }
}

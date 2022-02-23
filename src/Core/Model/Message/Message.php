<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Resource;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#message
 * @method string getId()
 * @method Message setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Message setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method Message setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method Message setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method Message setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method Message setType(string $type = null)
 * @method int getVersion()
 * @method Message setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Message setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * @method Message setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 */
class Message extends Resource
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
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'sequenceNumber' => [static::TYPE => 'int'],
            'resource' => [static::TYPE => Reference::class],
            'resourceVersion' => [static::TYPE => 'int'],
            'type' => [static::TYPE => 'string'],
            'resourceUserProvidedIdentifiers' => [static::TYPE => UserProvidedIdentifiers::class, static::OPTIONAL => true],
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

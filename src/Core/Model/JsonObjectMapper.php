<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonDeserializeInterface;

class JsonObjectMapper implements MapperInterface
{
    private $context;

    /**
     * JsonObjectMapper constructor.
     * @param $class
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        $this->context = $context;
    }

    /**
     * @param array $data
     * @param string $class class to map the data to
     * @return JsonDeserializeInterface|null
     */
    public function map(array $data, $class)
    {
        $object = forward_static_call_array([$class, 'fromArray'], [$data, $this->context]);
        return $object;
    }

    /**
     * @param $class
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}

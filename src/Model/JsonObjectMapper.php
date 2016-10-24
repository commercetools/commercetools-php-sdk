<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonDeserializeInterface;

class JsonObjectMapper implements MapperInterface
{
    private $context;
    private $class;

    /**
     * JsonObjectMapper constructor.
     * @param $class
     * @param Context $context
     */
    public function __construct($class, Context $context = null)
    {
        $this->class = $class;
        $this->context = $context;
    }

    /**
     * @inheritdoc
     * @return JsonDeserializeInterface|null
     */
    public function map(array $data)
    {
        $object = forward_static_call_array([$this->class, 'fromArray'], [$data, $this->context]);
        return $object;
    }

    /**
     * @param $class
     * @param Context $context
     * @return static
     */
    public static function of($class, Context $context = null)
    {
        return new static($class, $context);
    }
}

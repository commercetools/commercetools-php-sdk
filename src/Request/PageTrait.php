<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:39
 */

namespace Sphere\Core\Request;

use Sphere\Core\Request\Query\Parameter;
use Sphere\Core\Request\Query\ParameterInterface;

/**
 * Class PageableTrait
 * @package Sphere\Core\Request
 * @method $this addParamObject(ParameterInterface $param)
 */
trait PageTrait
{
    /**
     * @param int $limit
     * @return $this
     */
    public function limit($limit)
    {
        if (!is_null($limit)) {
            $this->addParamObject(new Parameter('limit', $limit));
        }

        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function offset($offset)
    {
        if (!is_null($offset)) {
            $this->addParamObject(new Parameter('offset', $offset));
        }

        return $this;
    }
}

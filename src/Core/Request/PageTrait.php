<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:39
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @package Commercetools\Core\Request
 */
trait PageTrait
{
    /**
     * @param ParameterInterface $param
     * @return $this
     */
    abstract public function addParamObject(ParameterInterface $param);

    /**
     * @param int $limit
     * @return $this
     */
    public function limit($limit)
    {
        if (!is_null($limit)) {
            $limit = max(0, min(PageRequestInterface::MAX_PAGE_SIZE, $limit));
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

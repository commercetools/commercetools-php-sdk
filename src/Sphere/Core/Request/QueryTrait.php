<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:26
 */

namespace Sphere\Core\Request;

/**
 * Class QueryTrait
 * @package Sphere\Core\Request
 * @method addParam($key, $value)
 */
trait QueryTrait
{
    public function where($where)
    {
        if (!is_null($where)) {
            $this->addParam('where', $where);
        }

        return $this;
    }

    public function sort($sort)
    {
        if (!is_null($sort)) {
            $this->addParam('sort', $sort);
        }

        return $this;
    }

    public function limit($limit)
    {
        if (!is_null($limit)) {
            $this->addParam('limit', $limit);
        }

        return $this;
    }

    public function offset($offset)
    {
        if (!is_null($offset)) {
            $this->addParam('offset', $offset);
        }

        return $this;
    }

    public function setQueryParams($where, $sort, $limit, $offset)
    {
        $this->where($where)->sort($sort)->limit($limit)->offset($offset);
    }
}

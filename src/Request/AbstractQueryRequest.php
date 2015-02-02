<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:27
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\JsonEndpoint;

/**
 * Class AbstractQueryRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractQueryRequest extends AbstractPagedRequest
{
    use QueryTrait;

    /**
     * @param JsonEndpoint $endpoint
     * @param string $where
     * @param string $sort
     * @param int $limit
     * @param int $offset
     */
    public function __construct(JsonEndpoint $endpoint, $where = null, $sort = null, $limit = null, $offset = null)
    {
        parent::__construct($endpoint, $sort, $limit, $offset);
        $this->where($where);
    }
}

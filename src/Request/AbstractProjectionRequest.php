<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:44
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\JsonEndpoint;

abstract class AbstractProjectionRequest extends AbstractPagedRequest
{
    use StagedTrait;

    /**
     * @param JsonEndpoint $endpoint
     * @param bool $staged
     * @param string $sort
     * @param int $limit
     * @param int $offset
     */
    public function __construct(JsonEndpoint $endpoint, $sort = null, $limit = null, $offset = null, $staged = false)
    {
        parent::__construct($endpoint, $sort, $limit, $offset);
        $this->staged($staged);
    }

    /**
     * @return string
     */
    abstract protected function getProjectionAction();

    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getProjectionAction() . $this->getParamString();
    }
}

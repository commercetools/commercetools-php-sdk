<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:44
 */

namespace Sphere\Core\Request;


/**
 * Class AbstractProjectionRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractProjectionRequest extends AbstractPagedRequest
{
    use StagedTrait;

    /**
     * @return string
     */
    abstract protected function getProjectionAction();

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getProjectionAction() . $this->getParamString();
    }
}

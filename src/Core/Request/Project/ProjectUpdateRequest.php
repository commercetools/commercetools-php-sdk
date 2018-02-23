<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project;

use Commercetools\Core\Client\JsonEndpoint;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Project
 * @link https://docs.commercetools.com/http-api-projects-project.html#update-project
 * @method Project mapResponse(ApiResponseInterface $response)
 * @method Project mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProjectUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = Project::class;

    /**
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($version, array $actions = [], Context $context = null)
    {
        parent::__construct(new JsonEndpoint(''), null, $version, $actions, $context);
    }

    /**
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofVersion($version, Context $context = null)
    {
        return new static($version, [], $context);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . $this->getParamString();
    }
}

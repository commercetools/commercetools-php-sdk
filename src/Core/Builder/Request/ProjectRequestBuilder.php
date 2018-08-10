<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Request\Project\ProjectUpdateRequest;
use Commercetools\Core\Model\Project\Project;

class ProjectRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#get-project
     *
     * @return ProjectGetRequest
     */
    public function get()
    {
        $request = ProjectGetRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-project.html#update-project
     * @param Project $project
     * @return ProjectUpdateRequest
     */
    public function update(Project $project)
    {
        $request = ProjectUpdateRequest::ofVersion($project->getVersion());
        return $request;
    }

    /**
     * @return ProjectRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}

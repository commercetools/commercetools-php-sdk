<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\Project\Project;
use Commercetools\Core\Request\Project\ProjectGetRequest;
use Commercetools\Core\Request\Project\ProjectUpdateRequest;

class ProjectRequestBuilder
{
    /**
     * @param Project $project
     * @return ProjectUpdateRequest
     */
    public function update(Project $project)
    {
        return ProjectUpdateRequest::ofVersion($project->getVersion());
    }

    /**
     * @return ProjectGetRequest
     */
    public function get()
    {
        return ProjectGetRequest::of();
    }
}

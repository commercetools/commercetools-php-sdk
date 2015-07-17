<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Project;


use Sphere\Core\RequestTestCase;

class ProjectFetchRequestTest extends RequestTestCase
{
    public function testMapResult()
    {
        $result = $this->mapResult(ProjectFetchRequest::of());
        $this->assertInstanceOf('\Sphere\Core\Model\Project\Project', $result);
    }
}

<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:07
 */

namespace Sphere\Core\Client;

/**
 * Class FileRequest
 * @package Sphere\Core\Http
 * @internal
 */
class FileRequest extends HttpRequest
{
    protected $file;

    public function __construct($method, $path, $file, $contentType)
    {
        $this->file = $file;
        parent::__construct($method, $path, null, $contentType);
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    protected function setFile($file)
    {
        $this->file = $file;
    }
}

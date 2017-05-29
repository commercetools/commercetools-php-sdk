<?php
/**
 * Origin: https://github.com/guzzle/log-subscriber
 * Copyright (c) 2014 Michael Dowling, https://github.com/mtdowling <mtdowling@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Commercetools\Core\Helper\Subscriber\Log;

use Psr\Log\LoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * Simple logger implementation that can write to a function, resource, or
 * uses echo() if nothing is provided.
 */
class SimpleLogger implements LoggerInterface
{
    use LoggerTrait;

    private $writeTo;

    public function __construct($writeTo = null)
    {
        $this->writeTo = $writeTo;
    }

    public function log($level, $message, array $context = array())
    {
        if (is_resource($this->writeTo)) {
            fwrite($this->writeTo, "[{$level}] {$message}\n");
        } elseif (is_callable($this->writeTo)) {
            call_user_func($this->writeTo, "[{$level}] {$message}\n");
        } else {
            echo "[{$level}] {$message}\n";
        }
    }
}

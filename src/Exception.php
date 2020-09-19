<?php

namespace SendGrid\Mail;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class Exception
 *
 * An exception thrown when SendGrid does not return a 200.
 *
 * @package SendGrid
 */
class GridException extends \RuntimeException {

}

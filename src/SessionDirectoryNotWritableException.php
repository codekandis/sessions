<?php declare( strict_types = 1 );
namespace CodeKandis\Sessions;

use LogicException;

/**
 * Represents an exception if a session directory is not writable.
 * @package codekandis/sessions
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionDirectoryNotWritableException extends LogicException
{
}

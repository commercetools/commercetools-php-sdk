<?php
namespace Commercetools\Core\Fixtures;

use Monolog\Formatter\LineFormatter;

class TeamCityFormatter extends LineFormatter
{
    const TC_FORMAT = "##teamcity[Log channel='%channel%' level='%level_name%' message='%message%' context='%context%' extra='%extra%']\n";

    private static $REPLACEMENTS = array(
        "|"  => "||",
        "'"  => "|'",
        "\n" => "|n",
        "\r" => "|r",
        "["  => "|[",
        "]"  => "|]",
    );
    /**
     * @param string $format                     The format of the message
     * @param string $dateFormat                 The format of the timestamp: one supported by DateTime::format
     * @param bool   $allowInlineLineBreaks      Whether to allow inline line breaks in log entries
     * @param bool   $ignoreEmptyContextAndExtra
     */
    public function __construct($format = null, $dateFormat = null, $allowInlineLineBreaks = false, $ignoreEmptyContextAndExtra = false)
    {
        $format = $format ?: static::TC_FORMAT;
        parent::__construct($format, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);
    }

    protected function convertToString($data)
    {
        return str_replace(array_keys(self::$REPLACEMENTS), array_values(self::$REPLACEMENTS), parent::convertToString($data));
    }
}

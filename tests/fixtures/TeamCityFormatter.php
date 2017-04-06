<?php
namespace Commercetools\Core\Fixtures;

use Monolog\Formatter\JsonFormatter;

class TeamCityFormatter extends JsonFormatter
{
    const TC_FORMAT = "##teamcity[message text='%s' status='%s']\n";

    private static $REPLACEMENTS = array(
        "|"  => "||",
        "'"  => "|'",
        "\n" => "|n",
        "\r" => "|r",
        "["  => "|[",
        "]"  => "|]",
    );

    /**
     * @inheritDoc
     */
    public function format(array $record)
    {
        if (isset($record['context']['responseBody']) &&
            isset($record['context']['responseHeaders']['content-type']) &&
            $record['context']['responseHeaders']['content-type'] == ['application/json']
        ) {
            $record['context']['responseBody'] = json_decode((string)$record['context']['responseBody']);
        }
        $str = str_replace(array_keys(self::$REPLACEMENTS), array_values(self::$REPLACEMENTS), parent::format($record));

        return sprintf(self::TC_FORMAT, $str, $record['level_name']);
    }
}

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

    private static $LEVEL_MAP = [
        "debug" => "NORMAL",
        "info" => "NORMAL",
        "notice" => "NORMAL",
        "warning" => "WARNING",
        "error" => "ERROR",
        "critical" => "ERROR",
        "alert" => "ERROR",
        "emergency" => "ERROR",
    ];

    /**
     * Return the JSON representation of a value
     *
     * @param  mixed             $data
     * @param  bool              $ignoreErrors
     * @throws \RuntimeException if encoding fails and errors are not ignored
     * @return string
     */
    protected function toJson($data, $ignoreErrors = false): string
    {
        $json = $this->jsonEncode($data);

        if ($json == false) {
            return parent::toJson($data, $ignoreErrors);
        }

        return $json;
    }

    private function jsonEncode($data)
    {
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * @inheritDoc
     */
    public function format(array $record): string
    {
        if (isset($record['context']['responseBody']) &&
            isset($record['context']['responseHeaders']['content-type']) &&
            strpos(current($record['context']['responseHeaders']['content-type']), 'application/json') !== false
        ) {
            $record['context']['responseBody'] = json_decode((string)$record['context']['responseBody']);
        }
        $str = str_replace(array_keys(self::$REPLACEMENTS), array_values(self::$REPLACEMENTS), parent::format($record));

        return sprintf(self::TC_FORMAT, $str, static::$LEVEL_MAP[strtolower($record['level_name'])]);
    }
}

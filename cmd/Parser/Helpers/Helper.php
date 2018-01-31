<?php

namespace AppiumCodeceptionCLI\Parser\Helpers;

class Helper
{
    /**
     * Get string between two chars.
     *
     * @param $data
     *
     * @return array
     *
     */
    public static function getBetweenAll($data)
    {
        $results = [];
        $endsAt = 0;

        do {
            $startsAt = (!$endsAt) ? strpos($data, ":") : strpos($data, ":", $endsAt);
            if ($startsAt !== false) {
                $endsAt = strpos($data, "/", $startsAt);
                if ($endsAt === false) {
                    $endsAt = strlen($data);
                }
                $results[] = [
                    'replace' => substr($data, $startsAt, $endsAt - $startsAt),
                    'parameterName' => substr($data, ($startsAt + 1), $endsAt - ($startsAt + 1))];
            }
        } while ($startsAt);


        return $results;
    }
}

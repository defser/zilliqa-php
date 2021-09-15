<?php
/**
 * @file
 * Helper functions to generate the API.
 *
 * @ingroup generators
 */

/**
 * @defgroup generators Generators
 *
 * Some files in Zilliqa-PHP are generated manually based on resources/zilliqa-schema.json.
 */

/**
 * @defgroup generated Generated
 *
 * Files in this group are generated based on resources/zilliqa-schema.json.
 */

require_once __DIR__ . '/../vendor/autoload.php';

function getSchema(): array
{
    return json_decode(file_get_contents(__DIR__ . "/../resources/zilliqa-schema.json"), true);
}

function printMe(string $title, $content = null): void
{
    echo "$title \n";
    if ($content) {
        if (is_array($content)) {
            print_r($content) . "\n";
        } else {
            echo ($content) . "\n";
        }
    }
}

function addUseStatement($type, &$useStatements): void
{
    if (is_array($type)) {
        foreach ($type as $subtype) {
            if (!in_array($subtype, $useStatements)) {
                $useStatements[] = $subtype;
            }
        }
    } else {
        $useStatements[] = $type;
    }
}

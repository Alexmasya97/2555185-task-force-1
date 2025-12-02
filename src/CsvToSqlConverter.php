<?php

namespace HtmlAcademy;

use SplFileObject;
use SplFileInfo;

class CsvToSqlConverter
{
public static function convert(string $filePath): void
{
    $fileObject = new SplFileObject($filePath);
    $fileInfo = new SplFileInfo($filePath);
    $tableName = $fileInfo->getBasename('.' . $fileInfo->getExtension());
    $sql = "INSERT INTO {$tableName}";
    $values = [];

    do{
        $row = $fileObject->fgetcsv();

        if($fileObject->key() === 0) {
            $sql .= ' (' . implode(',', $row) .') VALUES' . PHP_EOL;
            continue;
        }
        $values[] = "\t(" . implode(',',
            array_map(
                callback: function (string $value){
                    return "'{$value}'";
                },
                array: $row
            )
        ). ')';

    } while(!$fileObject->eof());
    $sql .= implode(',' . PHP_EOL, $values) . ';';

    $outDirPath = dirname($filePath);
    if (!file_put_contents("$outDirPath/$tableName.sql", $sql)) {
        throw new \Exception('file Id error');
    }
}
}

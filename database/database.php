<?php
class DataBase
{
    private $dataPath;

    public function __construct()
    {
        $this->dataPath = 'database/data/';
    }

    public function addToTable( $tableName, $input )
    {
        $filePath = $this->dataPath . $tableName;
        $tableData = [];
        $input = $this->parseInput( $input );

        if (file_exists( $filePath )) {
            $tableData = $this->getTableContents( $tableName );
        }

        $id = count( $tableData ) + 1;
        foreach($input as $inputValue) {
            $inputValue->id = $id++;
            $tableData[] = $inputValue;
        }

        file_put_contents( $filePath, json_encode( $tableData ), FILE_USE_INCLUDE_PATH );
    }

    public function getTableContents( $tableName )
    {
        $filePath = $this->dataPath . $tableName;
        if (!file_exists( $filePath )) return false;

        $fileContents = file_get_contents( $filePath );
        return json_decode( $fileContents );
    }

    private function isAssociative( $array )
    {
        return array_keys( $array ) !== range( 0, count( $array ) - 1 );
    }

    private function parseInput( $object )
    {
        $objects = [];

        if (is_array( $object )) {
            if ($this->isAssociative( $object )) {
                $objects[] = (object)$object;
            } else {
                foreach ($object as $value) {
                    if (is_array( $value )) $value = (object)$value;
                    $objects[] = $value;
                }
            }
        } else {
            $objects[] = $object;
        }

        return $objects;
    }
}
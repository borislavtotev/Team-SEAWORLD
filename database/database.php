<?php
/*
 * DataBase class to handle the data
 *
 *          PUBLIC API
 * ================================
 * If no such table exists, it creates new with name equal to the first parameter!
 * The input must be associative array or object for single entry insertion!
 * In case you need to add multiple items, pass them as array of associative arrays and/or objects!
 * function addToTable( tableName, input );
 * ================================
 * Returns array with the entries in the table with name equal to the first parameter
 * The entries are objects
 * In case no entries are available and/or table with this name exists, empty array is returned
 * function getTableContents( tableName );
 * ================================
 * Removes element from the table with id equal to the second parameter
 * If no such element exists, no action is taken!
 * function removeItemById( $tableName, $id );
 * ================================
 */
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

        $id = 1;
        if (!empty( $tableData )) {
            $id = $tableData[ count( $tableData ) - 1 ]->id + 1;
        }

        foreach($input as $inputValue) {
            $inputValue->id = $id++;
            $tableData[] = $inputValue;
        }

        file_put_contents( $filePath, json_encode( $tableData ), FILE_USE_INCLUDE_PATH );
    }

    public function getTableContents( $tableName )
    {
        $filePath = $this->dataPath . $tableName;
        if (!file_exists( $filePath )) return [];

        $fileContents = file_get_contents( $filePath );
        return json_decode( $fileContents );
    }

    public function removeItemById( $tableName, $id )
    {
        $tableData = $this->getTableContents( $tableName );
        $filtered = [];
        $entryExists = false;

        foreach ($tableData as $entry) {
            if ($entry->id != $id) {
                $filtered[] = $entry;
            } else {
                $entryExists = true;
            }
        }

        if ($entryExists) {
            $filePath = $this->dataPath . $tableName;
            file_put_contents( $filePath, json_encode( $filtered ), FILE_USE_INCLUDE_PATH );
        }
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
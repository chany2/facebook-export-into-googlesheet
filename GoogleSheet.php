<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 6:33 AM
 */

class GoogleSheet
{
    public function __construct()
    {
    }

    /*
     * List of all SpreadSheet
     */
    public static function getAllSpreadSheetFeed()
    {
        $spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
        $spreadsheetFeed = $spreadsheetService->getSpreadsheets();

        return $spreadsheetFeed;
    }
    
    /*
     * List of all worksheets
     */

    public static function getWorksheets($feedTitle)
    {
        $spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
        $spreadsheetFeed = $spreadsheetService->getSpreadsheets();
        $spreadsheet = $spreadsheetFeed->getByTitle($feedTitle);
        $worksheetFeed = $spreadsheet->getWorksheets();

        return $worksheetFeed;
    }

    /*
     * Get list-based row
     * How to loop the data
     * foreach ($listBaseRows->getEntries() as $entry)
        {
            $values[] = $entry->getValues();
        }
     */
    public static function getListBaseFeed($sheet, $workSheetName)
    {
        $spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
        $spreadsheetFeed = $spreadsheetService->getSpreadsheets();
        $spreadsheet = $spreadsheetFeed->getByTitle($sheet);
        $worksheetFeed = $spreadsheet->getWorksheets();
        $worksheet = $worksheetFeed->getByTitle($workSheetName);
        $listFeed = $worksheet->getListFeed();

        return $listFeed;
    }


    public static function getOnlyFieldFromListBaseFeed($sheet, $workSheetName, $field)
    {
        $listBaseFeeds = self::getListBaseFeed($sheet, $workSheetName);
        $fields = [];
        $values = [];

        foreach ($listBaseFeeds->getEntries() as $entry)
        {
            $values[] = $entry->getValues();
        }

        $i=0;
        if (count($values) > 0)
        {
            foreach ($values as $value) {
                $fields[] = $values[$i][$field];
                $i++;
            }
        }


        return $fields;
    }

    /*
     * Add list row
     */
    public static function addListRow($sheet, $workSheetName, $data)
    {
        $spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
        $spreadsheetFeed = $spreadsheetService->getSpreadsheets();
        $spreadsheet = $spreadsheetFeed->getByTitle($sheet);
        $worksheetFeed = $spreadsheet->getWorksheets();
        $worksheet = $worksheetFeed->getByTitle($workSheetName);
        $listFeed = $worksheet->getListFeed();

        $currentId = self::getOnlyFieldFromListBaseFeed($sheet, $workSheetName, 'id');

        foreach ($data as $row)
        {
            if (!in_array($row['id'], (array)$currentId)) {

                $listFeed->insert($row);
            }
        }
    }

    /*
     * Add header for a worksheet
     */
    public static function addHeaderToWorkSheet()
    {
        $spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
        $spreadsheetFeed = $spreadsheetService->getSpreadsheets();
        $spreadsheet = $spreadsheetFeed->getByTitle('test');
        $worksheetFeed = $spreadsheet->getWorksheets();
        $worksheet = $worksheetFeed->getByTitle('Sheet 2');
        $cellFeed = $worksheet->getCellFeed();

        $cellFeed->editCell(1,1, "Row1Col1Header");
        $cellFeed->editCell(1,2, "Row1Col2Header");
        $cellFeed->editCell(1,3, "Row1Col3Header");
        $cellFeed->editCell(1,4, "Row1Col4Header");
    }
}
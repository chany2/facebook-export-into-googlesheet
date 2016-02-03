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
}
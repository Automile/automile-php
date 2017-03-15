<?php

namespace Automile\Sdk\Models;

use Automile\Sdk\Types\ContentType;

/**
 * ExpenseReportRowContent Model
 *
 * @see ContentType
 *
 * @method int getExpenseReportRowContentId()
 * @method int getExpenseReportRowId()
 * @method int getContentType()
 * @method string getContentFileName()
 * @method string getData() base64-encoded raw data upon uploading
 * @method string getDataFile() path to the attachment file upon uploading
 *
 * @method ExpenseReportRowContent setExpenseReportRowContentId(int $expenseReportRowContentId)
 * @method ExpenseReportRowContent setExpenseReportRowId(int $expenseReportRowId)
 * @method ExpenseReportRowContent setContentType(int $contentType)
 * @method ExpenseReportRowContent setContentFileName(string $filename)
 * @method ExpenseReportRowContent setData(string $data)
 * @method ExpenseReportRowContent setDataFile(string $dataFile)
 */
class ExpenseReportRowContent extends ModelAbstract
{

    protected $_allowedProperties = [
        "ExpenseReportRowContentId",
        "ExpenseReportRowId",
        "ContentType",
        "ContentFileName",
        "Data",
        "DataFile"
    ];

    /**
     * @return array
     * @throws ModelException
     */
    public function toArray()
    {
        $data = parent::toArray();

        if (!empty($data['DataFile'])) {
            if (!empty($data['Data'])) {
                throw new ModelException('Content data already exists');
            }

            $content = @file_get_contents($data['DataFile']);
            if (!$content) {
                throw new ModelException("Data File is empty or inaccessible: '{$data['DataFile']}");
            }

            $data['Data'] = base64_encode($content);

            if (!isset($data['ContentType'])) {
                $data['ContentType'] = ContentType::getByFilename($data['DataFile']);
            }

            unset($data['DataFile']);
        }

        return $data;
    }

}

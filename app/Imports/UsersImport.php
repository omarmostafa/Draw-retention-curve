<?php

namespace App\Imports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class UsersImport extends BaseImport implements OnEachRow, WithHeadingRow
{

    /**
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        # get row as array
        $row = $row->toArray();
        # check if is array it will push this row to array and else it will push it to collection
        if ($this->asArray)
            $this->csvAdapter->pushOnArray($row);
        else
            $this->csvAdapter->pushOnCollection(new Applicant($row));
    }
}

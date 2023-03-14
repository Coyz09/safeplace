<?php

namespace App\Imports;

use App\Models\PoliceStationReports;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Police_Substation_ReportsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PoliceStationReports([
            'barangay' => $row['barangay'],
            'street' => $row['street'],
            'date_reported' => $row['date_reported'],
            'time_reported' => $row['time_reported'],
            'date_commited' => $row['date_commited'],
            'time_commited' => $row['time_commited'],
            'incident_type' => $row['incident_type'],
        ]);
    }
}

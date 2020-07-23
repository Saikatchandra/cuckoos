<?php

namespace App\Imports;

use App\Test;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TestImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Test([
            'username' => $row['username'],
            'name' => $row['name'],
            'referral_count' => $row['referral_count'],
            'account_at' => $row['created_at'],
            'referrer_id' => $row['referrer_id'],
            'email' => $row['email'],
            'phone' => $row['phone_number'],
        ]);
    }
}

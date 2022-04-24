<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\EwcCode;
use App\Models\Substance;
use Illuminate\Support\Collection;

class R4Import implements \Maatwebsite\Excel\Concerns\ToCollection
{
    public $created = [];
    public $problems = [];

    public function __construct(&$created, &$problems) {
        $this->created = &$created;
        $this->problems = &$problems;
    }

    /**
     * @inheritDoc
     */
    public function collection(Collection $rows)
    {
        $r4 = EwcCode::where('code', 'R4')->firstOrFail();
        $rows->skip(2)->each(function ($row) use($r4, &$failRows) {
            try {
                $car = Car::where('demolition_certificate_number', $row[4])->firstOrFail();
                $car->substances()->updateOrCreate([
                    'date' => Carbon::createFromTimestamp(strtotime($row[0])),
                    'ewc_code_id' => $r4->id,
                    'part_name' => $row[7],
                    'mass' => $row[2],
                ]);
                $this->created[] = $row;
            }catch (\Exception $e) {
                $this->problems[] = $row;
                logger($e->getMessage());
            }

        });
    }
}
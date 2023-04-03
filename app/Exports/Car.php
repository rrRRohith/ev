<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Car implements FromCollection ,WithMapping, WithHeadings{
    protected $collection;

    function __construct(Collection $collection) {
        $this->collection = $collection;
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return $this->collection;
    }

    /**
     * Set headers for the excel
     * @return array
     */
	public function headings():array{
        return [
            'Name', 'Description', 'Make', 'Trim', 'Drive range', 'Charger type', 'Charging time',
        ];
    }

    /**
     * Manipulate data as needed.
     * @return array
     */
	public function map($item): array{
        return [
			$item->name,
            $item->description,
            $item->make,
            $item->trim,
            $item->drive_range,
            $item->charger_type,
            $item->charging_time,
        ];
    }
}

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

class Station implements FromCollection ,WithMapping, WithHeadings{
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
            'Name', 'Description', 'Address', 'Price', 'Charger type', 'Charging speed', 'Latitude', 'Longitude'
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
            $item->address,
            $item->price,
            $item->charger_type,
            $item->	charging_speed,
            $item->latitude,
            $item->longitude,
        ];
    }
}

<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ExcelExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    public Collection $collect;
    public array $thead;
    public array $map;

    /**
     * @return \Illuminate\Support\Collection
     * $map=[
     *  'column_name'=>user.name // default column name
     *  'column_name'=>['is_trans'=>true,'all_lang'=>true,]
     *  'column_name'=>['local_value'=> value in base.php]
     * ]
     * $option=[
     *  'trans_header'=>true,
     * ]
     */
    public function __construct($collect, $map, $new_option = [])
    {
        $main_option = [
            'trans_header' => true,
        ];
        $option = array_merge($main_option, $new_option);
        $this->collect = $collect;
        $header = [];
        $maps = [];
        foreach ($map as $key => $value) {
            $header[] = data_get($option, 'trans_header') ? __('column.' . (is_int($key) ? $value : $key)) : (is_int($key) ? $value : $key);
            if (is_array($value)) {
                $maps[] = [...$value, 'key' => $key];
            } else {
                $maps[] = $value;
            }
        }
        $this->thead = $header;
        $this->map = $maps;
    }

    public function collection(): Collection
    {
        return $this->collect;
    }

    public function headings(): array
    {
        return $this->thead;
    }

    public function map($item): array
    {
        $row = [];
        foreach ($this->map as $c) {
            $z = $item;
            if (is_array($c)) {
                if (data_get($c, 'is_trans')) {
                    $column_name = (explode('.', $c['key']));
                    $z = $z->getTranslations($column_name[0])[$column_name[1]];
                }
                if (data_get($c, 'local_value')) {
                    $z = __('base.' . $c['local_value'] . '.' . $z[$c['key']]);
                }
            }

            if (!is_array($c)) {
                foreach ((explode('.', $c)) as $t) {
                    $z = $z[$t] ?? null;
                    if (in_array($t, ['is_active', 'is_completed'])) {
                        $z = ($z == 1 ? __('base.yes') : __('base.no'));
                    }
                    if ($t == 'value_type') {
                        $z = ($z == 'fixed') ? 'قيمة ثابتة' : 'نسبة';
                    }
                    /*
                     * to solve problem when cast enum in model
                     * */
                    if (gettype($z) == 'object') {
                        if (isset($z->value))
                            $z = $z->value;
                    }
                }
            }
            array_push($row, $z);
        }
        return $row;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }
}

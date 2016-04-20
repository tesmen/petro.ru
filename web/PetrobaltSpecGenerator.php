<?php


class PetrobaltSpecGenerator
{
    private $fileName;

    const UTF8_BYTES = "\xEF\xBB\xBF";

    const COLUMN_POS_ID = 1;
    const COLUMN_POD_POS_ID = 2;
    const COLUMN_OBOZNACH_ID = 3;
    const COLUMN_NAIMENOV_ID = 4;
    const COLUMN_KOD_TYPE_ID = 5;
    const COLUMN_KEI_ID = 6;
    const COLUMN_KOLVO_ID = 7;
    const COLUMN_SINGLE_MASS_ID = 8;
    const COLUMN_COMMON_MASS_ID = 9;
    const COLUMN_POKR_ID = 11;
    const COLUMN_VZ_ID = 13;
    const COLUMN_MESTO_ID = 16;

    const COLUMN_MAX = 32;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    private function getResultFileHeaders()
    {
        $result = [];

        foreach ($this->getResultFileMap() as $colName => $varName) {
            $result[] = $colName;
        }

        return $result;

    }

    private function getResultFileMap()
    {
        return [
            'Ном'                       => null,
            'Поз'                       => 'pos',
            'Пп'                        => 'podpos',
            'Поз. Узла'                 => null,
            'Код типа'                  => null,
            'Место'                     => 'mesto',
            'Чертеж'                    => 'oboznachenie',
            'Наименование'              => 'naimenovanie',
            'Код мат'                   => 'kodMat',
            'КЕИ'                       => 'kei',
            'Кол'                       => 'kolvo',
            'Масса'                     => 'massaObsh',
            'Из'                        => null,
            'Покр'                      => 'pokr',
            'ГТК'                       => null,
            'ВЗак'                      => 'vz',
            'МСЧ'                       => null,
            'Цех пот'                   => null,
            'Дополнительная информация' => null,
        ];
    }

    private function parseInputSpecFile()
    {
        $result = [];
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($this->fileName);
        $sheet = $objPHPExcel->getSheet(1);

        foreach ($objPHPExcel->getSheet(1)->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $pos = $sheet->getCellByColumnAndRow(Detail::COLUMN_POS_ID, $rowIndex)->getValue();

            if (empty($pos) || $pos < 100) {
                continue;
            }

            $result[$pos] = new Detail($this->collectRow($sheet, $rowIndex));
        }

        return $result;
    }

    private function collectRow(PHPExcel_Worksheet $sheet, $rowIndex)
    {
        $result = [];

        foreach (range(0, self::COLUMN_MAX) as $columnIndex) {
            $result[$columnIndex] = $sheet->getCellByColumnAndRow($columnIndex, $rowIndex)->getValue();
        }

        return $result;
    }

    private function writeResult(array $data, $fileName)
    {
        $c = 0;
        array_unshift($data, $this->getResultFileHeaders());

        $fh = fopen($fileName, 'w');
        fputs($fh, self::UTF8_BYTES);

        foreach ($data as $row) {
            fputcsv($fh, $row, ';');
            $c++;
        }

        return $c;
    }

    private function getDetailsArrayData()
    {
        $c = 1;
        $result = [];
        $details = $this->parseInputSpecFile();

        foreach ($details as $detail) {
            $result[] = $this->convertDetailToArray($detail, $c);
            $c++;
        }

        return $result;
    }

    public function convertDetailToArray(Detail $detail, $c)
    {
        $result = [];

        foreach ($this->getResultFileMap() as $columnName => $varName) {
            if ('Ном' === $columnName) {
                $result[] = $c;
                continue;
            }

            if (is_null($varName)) {
                $result[] = '';
                continue;
            }

            $getMethod = 'get' . $varName;
            $result[] = $detail->$getMethod();
        }

        return $result;
    }

    public function getMyCsv($fileName)
    {
        $detailsArrayData = $this->getDetailsArrayData();
        $this->writeResult($detailsArrayData, $fileName);

        return true;
    }
}

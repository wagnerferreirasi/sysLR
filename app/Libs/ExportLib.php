<?php
namespace App\Libs;

class ExportLib
{
    private $table;

    private function generateTable(array $fields, array $rows)
    {
        $this->table = '<table border="1">' .
        $this->addHeader($fields) .
        $this->addBody($rows) .
        '</table>';

        return $this->table;
    }

    private function addHeader(array $fields)
    {
        $header = '<thead><tr>';

        foreach ($fields as $field) {
            $header .= '<th>' . $field . '</th>';
        }

        $header .= '</tr></thead>';

        return $header;
    }


    private function addBody(array $rows)
    {
        $body = '<tbody>';

        foreach ($rows as $row) {
            $body .= '<tr>';

            foreach ($row as $cell) {
                $body .= '<td>' . $cell . '</td>';
            }

            $body .= '</tr>';
        }

        $body .= '</tbody>';

        return $body;
    }

    private function download(string $filename)
    {
        $file = "$filename-" . strtotime('now') .  '.xls';

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$file}\"");
        header("Content-Description: PHP Generated Data");

        echo $this->table;
    }

    public static function export(string $filename, array $fields, array $rows, )
    {
        $export = new ExportLib();
        $export->generateTable($fields, $rows);
        $export->download($filename);

        return true;
    }
}

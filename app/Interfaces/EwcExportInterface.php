<?php

namespace App\Interfaces;

interface EwcExportInterface
{
    public function query();

    public function pdfStyles();

    public function headerView();

    public function bodyView();

    public function footerView();

    public function exportAsXlsx();

    public function exportAsCsv();

    public function exportAsPdf();
}

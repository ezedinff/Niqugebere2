<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PDFGenerator extends Controller
{
    public function usersPDF(){
        $fpdf = new Fpdf('P','mm','A4');

    }
}

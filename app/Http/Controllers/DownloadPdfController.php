<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Illuminate\Http\Request;

class DownloadPdfController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');
            $request->merge(['pdf_path' => $pdfPath]);
        }

        Brief::create($request->all());

        return redirect()->route('nom.de.la.route');
    }
}

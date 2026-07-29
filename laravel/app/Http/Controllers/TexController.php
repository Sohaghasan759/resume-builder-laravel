<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TexController extends Controller
{
    public function index()
    {
        return view('tex');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'texfile' => 'required|file|mimes:tex|max:10240',
        ]);

        $jobId = bin2hex(random_bytes(8));
        $jobDir = storage_path("app/uploads/$jobId");

        if (!File::exists($jobDir)) {
            File::makeDirectory($jobDir, 0777, true);
        }

        $file = $request->file('texfile');

        $texPath = $jobDir . '/input.tex';

        $file->move($jobDir, 'input.tex');

        // Fix LaTeX font cache permission issue
        putenv('HOME=/tmp');
        putenv('VARTEXFONTS=/tmp/texfonts');

        if (!File::exists('/tmp/texfonts')) {
            File::makeDirectory('/tmp/texfonts', 0777, true);
        }

        $cmd = sprintf(
            'cd %s && for i in 1 2; do pdflatex -interaction=nonstopmode -halt-on-error -output-directory %s %s; done 2>&1',
            escapeshellarg($jobDir),
            escapeshellarg($jobDir),
            escapeshellarg($texPath)
        );

        $output = shell_exec($cmd);

        $pdfPath = $jobDir . '/input.pdf';

        if (!file_exists($pdfPath)) {
            return back()->with(
                'error',
                "PDF তৈরি করা যায়নি.\n\n" . substr($output ?? '', -3000)
            );
        }

        return response()->download(
            $pdfPath,
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.pdf'
        )->deleteFileAfterSend(true);
    }
}
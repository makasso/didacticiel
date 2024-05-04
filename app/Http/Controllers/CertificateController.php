<?php

namespace App\Http\Controllers;

use App\Models\ExamensAttempt;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = ExamensAttempt::with(['student', 'examen'])->where('status', 'is_completed')->get();

        return view('admin.certificate.index', compact('certificates'));
    }
}

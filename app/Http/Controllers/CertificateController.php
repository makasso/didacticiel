<?php

namespace App\Http\Controllers;

use App\Models\ExamensAttempt;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = ExamensAttempt::with(['student', 'examen'])->where('is_completed', 1)->get();

        return view('admin.certificate.index', compact('certificates'));
    }

    public function show(int $id)
    {
        $certificate = ExamensAttempt::with(['student', 'examen'])->where(['is_completed' => 1, 'id' => $id])->first();

        return view('admin.certificate.show', compact('certificate'));
    }

}

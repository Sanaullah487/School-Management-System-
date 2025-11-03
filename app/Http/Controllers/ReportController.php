<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display the PDF in the browser
     */
    public function report1($pid)
    {
        // Fetch payment with related enrollment, student, and batch
        $payment = Payment::with('enrollment.student', 'enrollment.batch')->findOrFail($pid);

        // Create print content for PDF
        $print = "<div style='margin:20px; padding:20px; font-family: DejaVu Sans, sans-serif;'>";
        $print .= "<h1 style='text-align:center;'>Payment Receipt</h1>";
        $print .= "<hr/>";
        $print .= "<p><strong>Receipt No:</strong> " . $payment->id . "</p>";
        $print .= "<p><strong>Date:</strong> " . $payment->paid_date . "</p>";
        $print .= "<p><strong>Enrollment No:</strong> " . $payment->enrollment->enroll_no . "</p>";
        $print .= "<p><strong>Student Name:</strong> " . $payment->enrollment->student->name . "</p>";
        $print .= "<hr/>";

        $print .= "<table style='width:100%; border-collapse: collapse;' border='1'>";
        $print .= "<tr>";
        $print .= "<th>Batch</th>";
        $print .= "<th>Amount</th>";
        $print .= "</tr>";

        $print .= "<tr>";
        $print .= "<td style='text-align:center;'><b>" . $payment->enrollment->batch->name . "</b></td>";
        $print .= "<td style='text-align:center;'><b>" . $payment->amount . "</b></td>";
        $print .= "</tr>";
        $print .= "</table>";

        $print .= "<hr/>";
        $print .= "<p><strong>Printed Date:</strong> " . date('Y-m-d') . "</p>";
        $print .= "</div>";

        // Load PDF and display in browser
        $pdf = Pdf::loadHTML($print);
        return $pdf->stream('payment_report_' . $payment->id . '.pdf');
    }
}

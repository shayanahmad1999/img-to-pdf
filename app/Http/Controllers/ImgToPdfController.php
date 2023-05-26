<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

class ImgToPdfController extends Controller
{
    public function convertToPDF(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the uploaded image file
        $image = $request->file('img');

        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        // Get the image data and create a data URI
        $imageData = file_get_contents($image->path());
        $imageBase64 = base64_encode($imageData);
        $imageUri = 'data:' . mime_content_type($image->path()) . ';base64,' . $imageBase64;

        // Load the HTML content with the embedded image
        $html = '<img src="' . $imageUri . '">';
        $dompdf->loadHtml($html);

        // Set paper size and rendering options
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Generate a unique filename for the PDF
        $pdfName = time() . '.pdf';

        // Get the PDF content
        $pdfContent = $dompdf->output();

        // Store the PDF in the storage directory
        $pdfPath = 'converted_images/' . $pdfName;
        Storage::put($pdfPath, $pdfContent);

        // Move the PDF file to the public directory
        $publicPath = 'public/' . $pdfPath;
        Storage::move($pdfPath, $publicPath);


        // Return the download link or any other response you want
        return redirect()->back()->with('pdfName', $pdfName);
        
    }
}

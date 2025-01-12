<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'subject'  => 'required|string|max:255',
            'message'  => 'required|string',
        ]);

        // Data email
        $data = [
            'email'    => $request->email,
            'subject'  => $request->subject,
            'message'  => $request->message,
        ];

        // Kirim email menggunakan fungsi Mail
        Mail::send([], [], function ($message) use ($data) {
            $message->to($data['email'])
                    ->subject($data['subject'])
                    ->html($data['message']);
        });

        // Redirect kembali dengan pesan sukses
        return redirect()->route('contact.form')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}

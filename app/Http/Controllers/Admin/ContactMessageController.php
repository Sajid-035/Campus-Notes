<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), fn ($q) => $q->where(function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%')
                    ->orWhere('subject', 'like', '%' . $request->q . '%');
            }))->latest()->paginate(20)->withQueryString();
        return view('backend.contact-messages.index', compact('messages'));
    }

    public function updateStatus(ContactMessage $contactMessage, Request $request): RedirectResponse
    {
        $data = $request->validate(['status' => ['required', 'in:new,read,resolved']]);
        $contactMessage->update($data);
        return back()->with('success', 'Contact message status updated.');
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();
        return back()->with('success', 'Contact message deleted.');
    }
}

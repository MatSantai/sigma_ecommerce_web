<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display the message board.
     */
    public function index()
    {
        $messages = Message::with('user')
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $pinnedMessages = Message::with('user')
            ->pinned()
            ->orderBy('created_at', 'desc')
            ->get();

        $highPriorityCount = Message::highPriority()->count();

        return view('messages.index', compact('messages', 'pinnedMessages', 'highPriorityCount'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'priority' => 'required|in:low,medium,high',
        ]);

        $message = Auth::user()->messages()->create($validated);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message posted successfully!');
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified message.
     */
    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified message.
     */
    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'priority' => 'required|in:low,medium,high',
        ]);

        $message->update($validated);

        return redirect()->route('admin.messages.show', $message)
            ->with('success', 'Message updated successfully!');
    }

    /**
     * Remove the specified message.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully!');
    }

    /**
     * Toggle pin status of a message.
     */
    public function togglePin(Message $message)
    {
        $message->update(['is_pinned' => !$message->is_pinned]);

        $action = $message->is_pinned ? 'pinned' : 'unpinned';
        return redirect()->route('admin.messages.index')
            ->with('success', "Message {$action} successfully!");
    }

    /**
     * Search messages by title or content.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $messages = Message::with('user')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('messages.index', compact('messages', 'query'));
    }
} 
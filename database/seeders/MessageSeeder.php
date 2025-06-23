<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users to create messages for
        $users = User::all();

        if ($users->count() === 0) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        $messages = [
            [
                'title' => 'Welcome to the Team Message Board!',
                'content' => "Hello everyone! Welcome to our new team message board. This is where we can communicate important updates, share information, and stay connected as a team.\n\nPlease feel free to post messages and let's keep the communication flowing!",
                'priority' => 'medium',
                'is_pinned' => true,
            ],
            [
                'title' => 'Important: System Maintenance Tonight',
                'content' => "We will be performing system maintenance tonight from 10:00 PM to 2:00 AM. During this time, the website may be temporarily unavailable.\n\nPlease plan your work accordingly and let us know if you have any questions.",
                'priority' => 'high',
                'is_pinned' => false,
            ],
            [
                'title' => 'New Product Launch Next Week',
                'content' => "We're excited to announce that we'll be launching our new product line next week! This is a great opportunity for our team to showcase our hard work.\n\nPlease review the product details and prepare for the launch event.",
                'priority' => 'medium',
                'is_pinned' => false,
            ],
            [
                'title' => 'Team Meeting Reminder',
                'content' => "Don't forget about our weekly team meeting tomorrow at 2:00 PM. We'll be discussing:\n- Project updates\n- New initiatives\n- Team feedback\n\nPlease come prepared with your updates!",
                'priority' => 'medium',
                'is_pinned' => false,
            ],
            [
                'title' => 'Office Supplies Available',
                'content' => "We've restocked the office supplies cabinet. New items include:\n- Notebooks\n- Pens and markers\n- Sticky notes\n- Printer paper\n\nFeel free to grab what you need!",
                'priority' => 'low',
                'is_pinned' => false,
            ],
            [
                'title' => 'Holiday Schedule Update',
                'content' => "Here's the updated holiday schedule for the upcoming months:\n\n- Memorial Day: May 27 (Office closed)\n- Independence Day: July 4 (Office closed)\n- Labor Day: September 2 (Office closed)\n\nPlease update your calendars accordingly.",
                'priority' => 'medium',
                'is_pinned' => false,
            ],
        ];

        foreach ($messages as $messageData) {
            // Randomly assign to different users
            $user = $users->random();
            
            Message::create([
                'user_id' => $user->id,
                'title' => $messageData['title'],
                'content' => $messageData['content'],
                'priority' => $messageData['priority'],
                'is_pinned' => $messageData['is_pinned'],
            ]);
        }

        $this->command->info('Sample messages created successfully!');
    }
} 
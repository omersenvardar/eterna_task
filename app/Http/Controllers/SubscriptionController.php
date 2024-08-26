<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function showTables()
    {
        $users = User::with('subscriptions')->get();
        return view('subscriptions.tables', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_id' => 'required|exists:users,id',
        ]);

        $subscription = Subscription::where('email', $request->email)
            ->where('user_id', $request->user_id)
            ->first();

        if ($subscription) {
            if ($subscription->status === 'active') {
                return redirect()->back()->with('error', 'You already have an active subscription with this email address!');
            } else {
                $subscription->status = 'active';
                $subscription->save();
                return redirect()->back()->with('success', 'Your subscription has been reactivated!');
            }
        }
        Subscription::create([
            'email' => $request->email,
            'user_id' => $request->user_id,
            'status' => 'active',
        ]);
        return redirect()->back()->with('success', 'Subscription successful!');
    }
    public function unsubscribe($email)
    {
        $email = urldecode($email);
        $subscription = Subscription::where('email', $email)->where('status', 'active')->first();
        if ($subscription) {

            $subscription->status = 'inactive';
            $subscription->save();

            return response()->view('emails.unsubscribed', ['email' => $email]);
        }

        return response()->view('emails.unsubscribe_error', ['email' => $email]);
    }
}

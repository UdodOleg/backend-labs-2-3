<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\SubscriptionCollection;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('subscriber')->paginate(10);
        return new SubscriptionCollection($subscriptions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscriber_id' => 'required|exists:subscribers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,expired,cancelled',
            'subscription_type' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $subscription = Subscription::create($validated);
        return new SubscriptionResource($subscription);
    }

    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'subscriber_id' => 'exists:subscribers,id',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'status' => 'in:active,expired,cancelled',
            'subscription_type' => 'string',
            'price' => 'numeric'
        ]);

        $subscription->update($validated);
        return new SubscriptionResource($subscription);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->noContent();
    }
}
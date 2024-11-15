<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Resources\SubscriberResource;
use App\Http\Resources\SubscriberCollection;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::paginate(10);
        return new SubscriberCollection($subscribers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'is_active' => 'boolean'
        ]);

        $subscriber = Subscriber::create($validated);
        return new SubscriberResource($subscriber);
    }

    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber);
    }

    public function update(Request $request, Subscriber $subscriber)
    {
        $validated = $request->validate([
            'email' => 'email|unique:subscribers,email,' . $subscriber->id,
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'is_active' => 'boolean'
        ]);

        $subscriber->update($validated);
        return new SubscriberResource($subscriber);
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return response()->noContent();
    }
}

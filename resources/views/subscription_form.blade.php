@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        <p class=" text-2xl">Subscribe to {{ $novel->title }}</p>
        <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"  action="/payment/add-funds/paypal">
            {{ csrf_field() }}
            <input type="hidden" name="novel" value="{{ $novel->title }}">
            <input type="hidden" name="novel_id" value="{{ $novel->id }}">
            <h2 class="w3-text-blue">Payment Form</h2>
            <p class="mb-8">Please select the pace at which you would like to read this novel and when you would like the subscription to start</p>
            <label for="pace" class="mb-8">Pace:
                @include('components.pace_dropdown', [
                    'novel' => $novel,
                    'subscription' => App\Subscription::make(['pace' => 1])
                ])
            </label>
            <label for="first_entry_date" class="mb-2">Start Date:
                <select name="first_entry_date" id="first_entry_date">
                    <option value="{{ now() }}">Now</option>
                    <option value="{{ $novel->first_entry_date }}">{{ $novel->first_entry_date->format('M j') }}</option>
                </select>
            </label>
            <p class="mb-8">Note: the second date above is the date of first entry in the actual novel</p>
            <label class="mb-8">
                Cost: {{ number_format(($novel->amount / 100), 2) }}€
                <input type="hidden" name="amount" value="{{ number_format(($novel->amount / 100), 2) }}">
            </label>
            <button class="w3-btn w3-blue">Subscribe to this Novel</button></p>
          </form>
    </section>
@endsection

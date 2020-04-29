@extends('layouts.dracula')

@section('js-footer')
<script
    src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=EUR&disable-funding=venmo,sepa,bancontact,eps,giropay,ideal,mybank,p24,sofort"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>
@endsection

@section('content')
    @include('default-banner')
    <section class="px-6 py-4 w-full">
        <h2 class="">Subscribe to {{ $novel->title }}</h2>
        <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"  action="/payment/add-funds/paypal">
            {{ csrf_field() }}
            <input type="hidden" name="novel" value="{{ $novel->title }}">
            <input type="hidden" name="novel_id" value="{{ $novel->id }}">
            <h4 class="w3-text-blue">Payment Form</h4>
            <p class="mb-8">Please select the type of subscription (full, gift, or trial), the pace at which you would like to read this novel, and when you would like the subscription to start</p>
            <fieldset class="flex flex-row flex-wrap w-2/3 mb-2">
                <legend class="mb-2 text-gray-700 font-bold">Subscription Type</legend>
                <div class="flex flex-col sm:flex-row w-full justify-between">
                    <label class="mb-8 mt-4 sm:mb-0 sm:mt-0" for="full"><input class="sub-type inline" type="radio" name="type" id="full" value="full" checked> Full ({{ $novel->amountAsCurrency() }}€)</label>
                    <label class="mb-8 sm:mb-0" for="gift"><input class="sub-type inline" type="radio" name="type" id="gift" value="gift"> Gift ({{ $novel->amountAsCurrency() }}€)</label>
                    <label class="mb-0" for="trial"><input class="sub-type inline" type="radio" name="type" id="trial" value="trial"> Trial (FREE!)</label>
                </div>
            </fieldset>
            <p id="type-full-description" class="mb-4 py-2 text-sm">This is the full subscription for the entire novel.</p>
            <p id="type-gift-description" class="mb-4 py-2 text-sm hidden">You can give subscriptions to people you know. Just enter their email address and when they've accepted the gift, they can start reading immediately. <b>Gifts are not anonymous</b>.
                <input class="block mt-2 w-2/3 " type="text" name="gift_email" id="gift_email" value="" placeholder="Enter recipient's email address here">
            </p>
            <p id="type-trial-description" class="mb-4 py-2 text-sm hidden">This is a trial subscription. It allows you to read the first {{ config('anovelexperience.number_of_trial_chapters') }} chapters of this novel.</p>
            <label for="pace" class="mb-4 py-2 text-gray-700 font-bold">Pace
                <p class="text-sm font-normal">At what pace should the emails be sent? "Standard" is the pace of the novel.</p>
                @include('components.pace_dropdown', [
                    'novel' => $novel,
                    'subscription' => App\Subscription::make(['pace' => 1])
                    ])
            </label>
            <label for="first_entry_date" class="mb-4 text-gray-700 font-bold">Start Date
                <p class="text-sm font-normal">When should we send the first entry? "Now" means subsequent entries will be sent the same number of days later as in the novel.</p>
                <select name="first_entry_date" id="first_entry_date" class="block mt-2">
                    <option value="{{ now() }}">Now</option>
                    <option value="{{ $novel->first_entry_date }}">{{ $novel->first_entry_date->format('M j') }} (date of first entry in the novel)</option>
                </select>
            </label>
            <input type="hidden" name="amount" id="amount" value="{{ number_format(($novel->amount / 100), 2) }}">
            <button id="trial-submit-button" class="w-full sm:w-1/2 mb-32 self-center hidden w3-btn w3-blue">Subscribe to this Novel</button></p>
            <div id="paypal-button-container" class="w-2/3 self-center"></div>
          </form>
          <script>
              document.addEventListener('DOMContentLoaded', (event) => {
                  let typeSelect = document.querySelectorAll('.sub-type');
                  typeSelect.forEach((rad) => {

                      rad.addEventListener('input', (event) => {
                          let elem = event.currentTarget;
                          let fullElem = document.querySelector('#type-full-description');
                          let giftElem = document.querySelector('#type-gift-description');
                          let trialElem = document.querySelector('#type-trial-description');
                          let trialSubmitButton = document.querySelector('#trial-submit-button');
                          let paypalSubmitButton = document.querySelector('#paypal-button-container');
                          let amount = document.querySelector('#amount');
                          switch( elem.value ) {
                                case 'full':
                                    fullElem.classList.remove('hidden');
                                    giftElem.classList.add('hidden');
                                    trialElem.classList.add('hidden');
                                    trialSubmitButton.classList.add('hidden');
                                    paypalSubmitButton.classList.remove('hidden');
                                    break;
                                case 'gift':
                                    fullElem.classList.add('hidden');
                                    giftElem.classList.remove('hidden');
                                    trialElem.classList.add('hidden');
                                    trialSubmitButton.classList.add('hidden');
                                    paypalSubmitButton.classList.remove('hidden');
                                    break;
                                default:
                                    fullElem.classList.add('hidden');
                                    giftElem.classList.add('hidden');
                                    trialElem.classList.remove('hidden');
                                    trialSubmitButton.classList.remove('hidden');
                                    paypalSubmitButton.classList.add('hidden');
                            }
                        });
                    });
                  paypal.Buttons({
                      createOrder: function(data, actions) {
                        // This function sets up the details of the transaction, including the amount and line item details.
                        let fed = document.querySelector('#first_entry_date').options[document.querySelector('#first_entry_date').selectedIndex].value;
                        let pace = document.querySelector('#pace').options[document.querySelector('#pace').selectedIndex].value;
                        let gift = document.querySelector('#gift');
                        let full = document.querySelector('#full');
                        let type = gift.checked == true ? 'gift' : 'full';
                        let gift_email = document.querySelector('#gift_email').value;
                        return actions.order.create({
                            "purchase_units": [{
                                "description": 'Subscription to {{ $novel->title }} by email',
                                "reference_id": '{{ $novel->id }}',
                                "custom": `{ "user_id": {{auth()->user()->id}}, "type": type, "pace": pace, "fed": fed, "gift_email": gift_email }`,
                                "amount": {
                                    "value": '{{ $novel->amountAsCurrency() }}'
                                },
                            }]
                        });
                    },

                    // Finalize the transaction
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            // Show a success message to the buyer
                            console.log(details);
                            alert('Transaction completed by ' + details.payer.name.given_name + '!');
                        });
                    },

                    onCancel: function (data) {
                        // Show a cancel page, or return to cart
                    },

                    onError: function (err) {
                        // Show an error page here, when an error occurs
                    }

                }).render('#paypal-button-container');
            });
            // This function displays Smart Payment Buttons on your web page.
          </script>
    </section>
@endsection

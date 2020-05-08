<div class="js-cookie-consent cookie-consent flex flex-col w-auto md:w-3/4 lg:w-1/2 font-sans bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
    <div class="flex">
      <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
      <div>
        <span class="cookie-consent__message">
            {!! trans('cookieConsent::texts.message') !!}
        </span>
        </div>
    </div>
    <button class="js-cookie-consent-agree cookie-consent__agree bg-blue-900
        self-center
        block
        p-6
        m-8
        w-64
        border-cool-gray-400
        rounded-md
        text-2xl
        text-white">
        {{ trans('cookieConsent::texts.agree') }}
    </button>
</div>

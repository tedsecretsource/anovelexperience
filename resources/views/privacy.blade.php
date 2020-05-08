@extends('layouts.dracula')

@section('content')
    @include('default-banner')
    <section class="px-6 py-4">
        <h1>Privacy Policy, Terms of Use, and Copyright</h1>
        <h2>Who we are</h2>
        <p>Our website address is: {{ env('APP_URL') }}.</p>
        <h2>What personal data we collect and why we collect it</h2>
        <h2>Your contact information</h2>
        <p>The only personal data we require is your email address. Your name can be either your real name or a pseudonym, or a handle. If you make a purchase, your contact information is stored with our payment gateway provider and is made available to us for financial reconiciliation purposes and to maintain the account in good standing.</p>
        <h2>Where we send your data</h2>
        <p>We use Google Analytics on this site. </p>
        <p>Visitor comments may be checked through an automated spam detection service.</p>
        <h2>Additional information</h2>
        <h3>How we protect your data</h3>
        <h3>What data breach procedures we have in place</h3>
        <h3>What third parties we receive data from</h3>
        <h3>What automated decision making and/or profiling we do with user data</h3>
        <h3>Industry regulatory disclosure requirements</h3>
        <h2>Copyright</h2>
        <p>This site and its contents are © 2020, anovelexperience.email. All rights reserved. These pages may not be copied or republished without our express written consent.</p>
        <p>The works that appear here are in the public domain. While we cannot assert copyright on the works themselves, we do claim a copyright on the site design, the HTML rendering of the text both on the site and emails, the site's look and feel, and the back-end code and database that runs the site.</p>
        <h3>Disclaimer</h3>
        <p>To the best of our knowledge, all works included here fall under the public domain guidelines of copyright law in the United States and elsewhere. If you believe that any work included violates a copyright you hold or represent, we will immediately remove it upon notification pending good-faith resolution of any dispute.</p>
        <p>This site and its contents are provided as is. We strive for accuracy but cannot be held responsible for any errors in the works reproduced here.</p>
    </section>
@endsection

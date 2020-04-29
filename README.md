1) Set up subscription process and gateway. 
2) Set up email sending engine (this is an automated task that gets all the active subscriptions and sends an entry if required and runs every 15 minutes). 
3) Configure and format the email so it uses a custom font and has some amount of design to it.
4) Migrate the whole project to the server!

I also need to resolve the issue with the credit card. I don't know what to do. The bank is virtually non-responsive and Mailgun doesn't show much interest in allowing me to pay with PayPal. We can still use the service to configure the system but can only send to 5 verified emails (you didn't verify your email address, BTW).

To make this site
- layout and design: learn and apply Tailwind (about the same as doing it from scratch)
- Authentication: scaffolding plus role-based PHP package and a little configuration
- CMS: Backpack plus a _lot_ of configuration, some trial and error, and a lot of review of the documentation
- Payment gateway: PayPal, mostly new JS API, seems to work well, only about a day to implement start to finish
- Fiddling with Laravel to get relationships, accessors, and such right
- Emails: configuring mailgun was easy once I got the credit card to work
- Emails: have yet to lay out fancy emails, might try Tailwind there too
- Emails: have to set up the cron jobs
- The diamond: scheduled sending of emails has been about 20% of the whole project


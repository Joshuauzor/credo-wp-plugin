=== Credo Payment Forms ===
Contributors: credo
Tags: Credo, payment form, payment gateway, bank account, credit card, debit card, nigeria, international, mastercard, visa
Donate link: http://credocentral.com/
Requires at least: 1.0.1
Tested up to: 5.8.2
Requires PHP: 5.4
Stable tag: 1.0.2
License: MIT
License URI: https://github.com/Credocentral/credo-payment-forms/blob/master/LICENSE

Accept Credit card, Debit card and Bank account payment directly on your WordPress site with the Credo payment gateway.




== Description ==

Signup for a live credo account at https://credocentral.com and a sandbox account

= Configuration options = 

* Pay Button Public Key (live/Test) - Enter your public key which can be retrieved from Settings > API on your Credo account dashboard.
* Pay Button Secret Key (live/Test) - Enter your secret key which can be retrieved from Settings > API on your Credo account dashboard.
* Go Live - Tick that section to turn your credo plugin live.
* Modal Title - (Optional) customize the title of the Pay Modal. Default is CREDO PAY.
* Modal Description - (Optional) customize the description on the Pay Modal. Default is FLW PAY MODAL.
* Modal Logo - (Optional) customize the logo on the Pay Modal. Enter a full url (with \'http\'). Default is Credo logo.
* Success Redirect URL - (Optional) The URL the user should be redirected to after a successful payment. Enter a full url (with 'http:\\'). Default: '\'.
* Failed Redirect URL - (Optional) The URL the user should be redirected to after a failed payment. Enter a full url (with 'http:\\'). Default: '\'.
* Pay Button Text - (Optional) The text to display on the button. Default: "PAY NOW".
* Charge Currency - (Optional) The currency the user is charged. Default: "NGN".
* Charge Country - (Optional) The country the merchant is serving. Default: "NG: Nigeria".
* Form Style - (Optional) Disable form default style and use the activated theme style instead.
* Click Save Changes to save your changes.

= Styling =

You can enable default theme's style to override default form style from the Settings page. Or you can override the formclass .credo-simple-pay-now-form from your stylesheet.

= Usage =

* a. Shortcode
Insert the shortcode anywhere on your page or post that you want the form to be displayed to the user.
Basic: requires the user to enter amount and email to complete payment
[credo-pay-button]


With button text:
[credo-pay-button]Button Text[/credo-pay-button]


With attributes: email or use_current_user_email with value "yes", amount
[credo-pay-button amount="1290" email="joshuauzor@gmail.com" ]

or

[credo-pay-button amount="1290" use_current_user_email="yes" ]


With attributes and button text: email, amount
[credo-pay-button amount="1290" email="joshuauzor@gmail.com" ]Button Text[/credo-pay-button]



With currency

[credo-pay-button custom_currency="NGN,USD"]

With attributes: email or use_current_user_email with value "yes", amount and currency
[credo-pay-button amount="1290" email="joshuauzor@gmail.com" custom_currency= "NGN, USD" ]

or

[credo-pay-button amount="1290" use_current_user_email="yes" custom_currency= "NGN, USD" ]

With currency:
[credo-pay-button custom_currency="NGN,USD"]

With attributes: email or use_current_user_email with value "yes", amount and currency
[credo-pay-button amount="1290" email="joshuauzor@gmail.com" custom_currency= "NGN, USD" ]

or

[credo-pay-button amount="1290" use_current_user_email="yes" custom_currency= "NGN, USD" ]


On the "Form Settings" dialog, fill in the form attributes and click "Save Changes".

Payment Form successfully added to the page. 


= Transaction List =
All the payments made through the forms to Credo can be accessed on Credo > Transactions page.


= TODO =
* Add advanced forms to include customisation where user can choose what fields to add to the form.
* Multiple Pay Button integrations.

= Suggestions / Contributions =
For issues, suggestions and feature request, click here. To contribute, fork the repo, add your changes and modifications, then create a pull request.



== Installation ==

Automatic Installation

* Login to your WordPress Dashboard.
* Click on "Plugins > Add New" from the left menu.
* In the search box type Credo Payment Forms.
* Click on Install Now on Credo Payment Forms to install the plugin on your site.
* Confirm the installation.
* Activate the plugin.
* Go to "Credo > Settings" from the left menu to configure the plugin.


Manual Installation

* Download the plugin zip file.
* Login to your WordPress Admin. Click on \"Plugins > Add New\" from the left menu.
* Click on the \"Upload\" option, then click \"Choose File\" to select the zip file you downloaded. Click \"OK\" and \"Install Now\" to complete the installation.
* Activate the plugin.
* Go to \"Credo > Settings\" from the left menu to configure the plugin.
* For FTP manual installation, check here.

= Configure the plugin =
To configure the plugin, go to Credo > Settings from the left menu.

== Frequently Asked Questions ==
Q: How do I get my Test public and secret keys ?
A: To get your test public and secret key visit this page to see how: https://docs.credocentral.com/guides/getting-started
Q: How do I move from test to production on the plugin ?
A: You need to toggle the go live check box by clicking on it, you also need to make sure your live keys have been added to the credo configuration page on wordpress.

Q: How do I charge my customers in multiple currencies ?
A: We allow you use shortcodes to append multiple currencies to the form shown to your customers simple embed with the currency shortcode style above.

== Screenshots ==

1. To configure the plugin, go to Credo > Settings from the left menu.
2. On the "Form Settings" dialog, fill in the form attributes and click "Save Changes". 
3. Payment Form successfully added to the page.
4. All the payments made through the forms to Credo can be accessed on Credo > Transactions page.



== Changelog ==
v 1.0.0
* No changelogs yet

v 1.0.0

== Upgrade Notice ==
v1.0.0 - 03/11/2021
* No upgrade yet
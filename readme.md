# Credo Payment Forms

 - **Contributors:** Joshua Uzor, Godswill Adie, Credo
 - **Tags:** Credo, payment form, payment gateway, bank account, credit card, debit card, mastercard, visa


Take donations and payments for services on your WordPress site using Credo.





## Installation


### Automatic Installation
*   Login to your WordPress Dashboard.
*   Click on "Plugins > Add New" from the left menu.
*   In the search box type __Credo Payment Forms__.
*   Click on __Install Now__ on __Credo Payment Forms__ to install the plugin on your site.
*   Confirm the installation.
*   Activate the plugin.
*   Go to "Credo > Settings" from the left menu to configure the plugin.


### Manual Installation
*  Download the plugin zip file.
*  Login to your WordPress Admin. Click on "Plugins > Add New" from the left menu.
*  Click on the "Upload" option, then click "Choose File" to select the zip file you downloaded. Click "OK" and "Install Now" to complete the installation.
*  Activate the plugin.
*  Go to "Credo > Settings" from the left menu to configure the plugin.




### Configure the plugin
To configure the plugin, go to __Credo > Settings__ from the left menu.

###

* __Pay Button Public Key__ - Enter your public key which can be retrieved from "Pay Buttons" page on your Credo account dashboard.

* __Modal Title__ - (Optional) customize the title of the Pay Modal. Default is Credo PAY.
* __Modal Description__ - (Optional) customize the description on the Pay Modal. Default is Credo PAY MODAL.
* __Modal Logo__ - (Optional) customize the logo on the Pay Modal. Enter a full url (with 'http'). Default is Credo logo.
* __Success Redirect URL__ - (Optional) The URL the user should be redirected to after a successful payment. Enter a full url (with 'http'). Default: "".
* __Failed Redirect URL__ - (Optional) The URL the user should be redirected to after a failed payment. Enter a full url (with 'http'). Default: "".
* __Pay Button Text__ - (Optional) The text to display on the button. Default: "PAY NOW".
* __Charge Currency__ - (Optional) The currency the user is charged. Default: "NGN".
* __Charge Country__ - (Optional) The country the merchant is serving. Default: "NG: Nigeria".
* __Form Style__ - (Optional) Disable form default style and use the activated theme style instead.
* Click __Save Changes__ to save your changes.

### Styling
You can enable default theme's style to override default form style from the __Settings__ page.
Or you can override the _form_ class `.credo-simple-pay-now-form` from your stylesheet.


## Usage ##

####1. Shortcode

Insert the shortcode anywhere on your page or post that you want the form to be displayed to the user.

Basic: _requires the user to enter amount and email to complete payment_
```
[credo-pay-button]
```

With button text:
```
[credo-pay-button]Button Text[/credo-pay-button]
```

With attributes: _email_ or _use_current_user_email_ with value "yes", _amount_
```
[credo-pay-button amount="1290" email="customer@email.com" ]

or

[credo-pay-button amount="1290" use_current_user_email="yes" ]
```

With attributes and button text: _email_, _amount_
```
[credo-pay-button amount="1290" email="customer@email.com" ]Button Text[/credo-pay-button]
```



## Transaction List ##

All the payments made through the forms to Credo can be accessed on __Credo > Transactions__ page.








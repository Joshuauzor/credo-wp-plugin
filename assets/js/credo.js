"use strict";

var form = jQuery(".credo-simple-pay-now-form"),
    redirectUrl;

if (form) {
    find;
    form.on("submit", function(evt) {
        evt.preventDefault();
        var config = buildConfigObj(this);
        // console.log(config);
        makePayment(config);
    });
}

/**
 * Builds config object to be sent to GetPaid
 *
 * @return object - The config object
 */
var buildConfigObj = function(form) {
    // console.log(form);
    var formData = jQuery(form).data();
    var amount = jQuery(form).find("#credo-amount").val() || formData.amount;
    var email =
        jQuery(form).find("#credo-customer-email").val() || formData.email;
    var firstname =
        jQuery(form).find("#credo-first-name").val() || formData.firstname;
    var lastname =
        jQuery(form).find("#credo-last-name").val() || formData.lastname;
    var formCurrency =
        jQuery(form).find("#credo-currency").val() || formData.currency;
    var paymentplanID = jQuery(form).find("#credo-payment-plan").val();
    var txref = "WP_" + form.id.toUpperCase() + "_" + new Date().valueOf();
    var setCountry; //set country

    if (formCurrency == "") {
        formCurrency = credo_options.currency;
        // console.log(credo_options);
    }

    //switch the country with form currency provided
    switch (formCurrency) {
        case "KES":
            setCountry = "KE";
            break;
        case "GHS":
            setCountry = "GH";
            break;
        case "ZAR":
            setCountry = "ZA";
            break;
        default:
            setCountry = "NG";
            break;
    }

    return {
        amount: amount,
        country: setCountry, //credo_options.country,
        currency: formCurrency,
        custom_description: credo_options.desc,
        custom_logo: credo_options.logo,
        custom_title: credo_options.title,
        customer_email: email,
        customer_firstname: firstname,
        customer_lastname: lastname,
        payment_method: credo_options.method,
        PBFPubKey: credo_options.pbkey,
        txref: txref,
        payment_plan: paymentplanID,
        onclose: function() {
            redirectTo(redirectUrl);
        },
        callback: function(res) {
            sendPaymentRequestResponse(res, form);
        },
    };
};

// var processCheckout = function(opts) {
//     getpaidSetup(opts);
// };

// credo make payment
const generateRandomNumber = (min, max) =>
    Math.floor(Math.random() * (max - min) + min);

const transRef = `iy67f${generateRandomNumber(10, 60)}hvc${generateRandomNumber(
  10,
  90
)}`;

// function makePayment(data) {
//     // console.log(credo_options.cb_url)
//     CredoCheckout({
//         transRef, //Please generate your own transRef that is unique for each transaction
//         amount: data.amount,
//         redirectUrl: credo_options.cb_url,
//         paymentOptions: ["CARDS", "BANK"],
//         currency: data.currency,
//         customerName: data.customer_firstname + ' ' + data.customer_lastname,
//         customerEmail: data.customer_email,
//         customerPhoneNo: data.phone,
//         onClose: function() {
//             redirectTo(redirectUrl);
//         },
//         callback: function() {
//             console.log('call back');
//             alert('stop');
//             // sendPaymentRequestResponse(res, data);
//         },
//         publicKey: data.PBFPubKey // You should store your API key as an environment variable
//     });
// }

function makePayment(data) {
    CredoCheckout({
        transRef, //Please generate your own transRef that is unique for each transaction
        amount: data.amount,
        // redirectUrl: "https://merchant-test-line.netlify.app/successful",
        paymentOptions: ["CARDS", "BANK"],
        currency: data.currency,
        customerName: data.customer_firstname + " " + data.customer_lastname,
        customerEmail: data.customer_email,
        customerPhoneNo: data.phone,
        onClose: function() {
            console.log("Modal closed");
        },
        callback: function(res) {
            console.log(data);
            sendPaymentRequestResponse(res, data);
        },
        publicKey: data.PBFPubKey, // You should store your API key as an environment variable
    });
}
// ends here

/**
 * Sends payment response from GetPaid to the process payment endpoint
 *
 * @param object Response object from GetPaid
 *
 * @return void
 */
var sendPaymentRequestResponse = function(res, form) {
    var args = {
        action: "process_payment",
        credo_sec_code: jQuery(".credo-simple-pay-now-form")
            .find("#credo_sec_code")
            .val(),
        credo_ref: res.merchantReferenceNo,
    };

    var dataObj = Object.assign({}, args, res.tx);

    jQuery.post(credo_options.cb_url, dataObj).success(function(data) {
        var response = JSON.parse(data);
        redirectUrl = response.redirect_url;
        // console.log(redirectUrl);
        // console.log("stop");
        if (redirectUrl === "") {
            var responseMsg =
                res.tx.paymentType === "account" ?
                res.tx.acctvalrespmsg :
                res.tx.vbvrespmessage;
            jQuery(form)
                .find("#notice")
                .text(responseMsg)
                .removeClass(function() {
                    return jQuery(form).find("#notice").attr("class");
                })
                .addClass(response.status);
        } else {
            setTimeout(redirectTo, 5000, redirectUrl);
        }
    });
};

/**
 * Redirect to set url
 *
 * @param string url - The link to redirect to
 *
 * @return void
 */
var redirectTo = function(url) {
    if (url) {
        location.href = url;
    }
};
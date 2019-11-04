    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'client_id'
        },
        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: '151.00',
                        currency: 'GBP'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                document.getElementById("response").style.display = 'inline-block';
                document.getElementById("response").innerHTML = 'Thank you for making the payment!';
            });
        }
    }, '#paypal-button');

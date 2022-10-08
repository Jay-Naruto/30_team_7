<?php
// Initialize the session
session_start();
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://js.stripe.com/v3/"></script>
    <title>Payment</title>
    <script>
      function premium(){
        
      }
    </script>
    <style>
.btn{
  background-color: black;
  border: none;
  color: white;
  border-radius: 20px;
  padding: 14px 20px;
  font-size: 20px;
  text-align: center;
  cursor: pointer;
}
    </style>
</head>
<body style="display:flex;flex-direction: row;justify-content: center;align-items: center;">
  <div style="display:flex;flex-direction: column;justify-content: center;align-items: center;width: 100%;">
<div>
  <h1>Get premium!</h1>

</div>
 <div>
  <!-- <button class="btn" onclick="premium()" id="checkout">Continue</button> -->
  <input type="submit" id="checkout" onclick="premium()" class="btn" />

 </div>
  </div>
  <div style="width:100%">
    <img class="banner-image" src="img/e-wallet-animate.svg" alt="monitoring" >
  </div>
    <script>
        var stripe = Stripe(
            "pk_test_51LpQxaSClQus7pNZ0lQl5OXXTRBljK1u01ZRUMbjpDftwojlCqmFxvfP73P1e1mbE89SXJtifG1zifX8yzBHQvyS00i1h5qv1Q"
        );
        document.getElementById("checkout").addEventListener("click", function() {
            stripe.redirectToCheckout({
                    lineItems:[
                        {
                            price:"price_1LqIhhSClQus7pNZnhtG5hU8",
                            quantity:1,
                        },
                    ],
                    mode: "subscription",
                    successUrl:"http://127.0.0.1:5000/success",
                    cancelUrl:"https://www.twitter.com/",
                    

            })
            .then(function (result) {
                console.log(result)
            });
        })
    </script>
</body>
</html>
$(".addtocart").on("click", function (event) {
    var product_id = $(this).data("data");
    var price = $(this).data("id");
    var token = $('meta[name="csrf-token"]').attr("content");
    var url = "/create/post/cart/";
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        method: "GET",
        url: url,
        data: {
            product_id: product_id,
            price: price,
        },
        dataType: "json",
        success: function (cart) {
            if (cart != null) {
                setTimeout(function () {
                    var message = document.getElementById(
                        "cart-success-message"
                    );
                    message.setAttribute("style", "display:block");
                }, 2000);
                var token = $('meta[name="csrf-token"]').attr("content");
                var url = "/count/post/cart/";
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    method: "GET",
                    url: url,
                    dataType: "json",
                    success: function (cartCount) {
                        var cart = document.getElementById("cartCount");
                        cart.innerHTML = cartCount;
                    },
                    error: function (request, status, error) {
                        console.log(request);
                    },
                });
                // location.reload();
            } else {
                var message = document.getElementById("cart-danger-message");
                message.setAttribute("style", "display:block");
            }
        },
        error: function (request, status, error) {
            console.log(request);
        },
    });
});

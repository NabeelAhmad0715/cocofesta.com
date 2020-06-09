$(".removetocart").on("click", function (event) {
    var link_data = $(this).data("data");
    var confirm = window.confirm(
        "Are you sure you want to remove this product?"
    );
    if (confirm) {
        var token = $('meta[name="csrf-token"]').attr("content");
        var url = "/remove/post/cart/";
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "GET",
            url: url,
            data: {
                post_id: link_data,
            },
            dataType: "json",
            success: function (data) {
                if (data === 1) {
                    var message = document.getElementById(
                        "cart-success-remove-message"
                    );
                    message.setAttribute("style", "display:block");
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
                            console.log(cartCount);

                            var cart = document.getElementById("cartCount");
                            cart.innerHTML = cartCount;
                        },
                        error: function (request, status, error) {
                            console.log(request);
                        },
                    });
                    location.reload();
                }
            },
            error: function (request, status, error) {
                console.log(request);
            },
        });
    }
});

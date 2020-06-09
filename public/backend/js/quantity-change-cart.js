$(document).on("change", ".change-quantity", function (event) {
    var quantity = $(this).val();
    var post_id = $(this).data("id");
    var price = $(this).data("data");
    var token = $('meta[name="csrf-token"]').attr("content");
    var url = "/cart/change/quantity/";
    if (quantity > 0) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "GET",
            url: url,
            data: {
                quantity: quantity,
                price: price,
                post_id: post_id,
            },
            dataType: "json",
            success: function (data) {
                var price = 0;
                $.each(data, function (index, data) {
                    var id = $("#cartPrice" + data.id).data("id");

                    if (data.id == id) {
                        $("#cartPrice" + data.id).empty();
                        $("#cartPrice" + data.id).append(data.price);
                    }
                    price = price + data.price;
                });
                $(".totalCartPrice").empty();
                $(".totalCartPrice").append(price);
            },
            error: function (request, status, error) {
                console.log(request);
            },
        });
    }
});

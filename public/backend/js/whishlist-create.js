$(document).ready(function () {
    $(".addtowishlist").on("click", function (event) {
        var link_data = $(this).data("data");
        var token = $('meta[name="csrf-token"]').attr("content");
        var url = "/create/post/whishlist/";
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "GET",
            url: url,
            data: {
                product_id: link_data,
            },
            dataType: "json",
            success: function (data) {
                if (data != null) {
                    var message = document.getElementById(
                        "whishlist-success-message"
                    );
                    message.setAttribute("style", "display:block");
                    var token = $('meta[name="csrf-token"]').attr("content");
                    var url = "/count/post/whishlist/";
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": token,
                        },
                        method: "GET",
                        url: url,
                        dataType: "json",
                        success: function (whishlistCount) {
                            console.log(whishlistCount);

                            var whishlist = document.getElementById(
                                "whishlistCount"
                            );
                            whishlist.innerHTML = whishlistCount;
                        },
                        error: function (request, status, error) {
                            console.log(request);
                        },
                    });
                } else {
                    var message = document.getElementById(
                        "whishlist-danger-message"
                    );
                    message.setAttribute("style", "display:block");
                }
            },
            error: function (request, status, error) {
                console.log(request);
            },
        });
    });
});

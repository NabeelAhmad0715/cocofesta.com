$(document).ready(function () {
    /* 1. Visualizing things on Hover - See next part for action on click */
    $("#stars li")
        .on("mouseover", function () {
            var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this)
                .parent()
                .children("li.star")
                .each(function (e) {
                    if (e < onStar) {
                        $(this).addClass("hover");
                    } else {
                        $(this).removeClass("hover");
                    }
                });
        })
        .on("mouseout", function () {
            $(this)
                .parent()
                .children("li.star")
                .each(function (e) {
                    $(this).removeClass("hover");
                });
        });

    /* 2. Action to perform on click */
    $("#stars li").on("click", function () {
        var onStar = parseInt($(this).data("value"), 10); // The star currently selected
        var stars = $(this).parent().children("li.star");

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass("selected");
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass("selected");
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt(
            $("#stars li.selected").last().data("value"),
            10
        );

        document.getElementById("rating").value = onStar;
    });
});

$(document).on("submit", "#reviewForm", function (event) {
    event.preventDefault();

    var message = document.getElementById("reviewMessage").value;
    var post_id = document.getElementById("post_id").value;
    var rating = document.getElementById("rating").value;

    console.log(rating);
    var token = $('meta[name="csrf-token"]').attr("content");
    var url = "/post/reviews/";
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        method: "POST",
        url: url,
        data: {
            rating: rating,
            message: message,
            post_id: post_id,
        },
        dataType: "json",
        success: function (data) {
            var message = document.getElementById("review-success-message");
            message.setAttribute("style", "display:block");
            location.reload();
        },
        error: function (request, status, error) {
            console.log(request);
        },
    });
});

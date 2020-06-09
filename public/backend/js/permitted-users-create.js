$(document).ready(function () {
    $(document).on("change", ".permitted-user-type", function () {
        var permittedUserType = $(this).val();
        var token = $('meta[name="csrf-token"]').attr("content");
        var url = "/headoffice/permitted-users/";
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "GET",
            url: url,
            data: {
                type: permittedUserType,
            },
            dataType: "json",
            success: function (data) {
                userDisplay = document.getElementById("dp-block");
                userDisplay.setAttribute("style", "display:block");
                $("#permitted_users").empty();
                if (data.length === 0) {
                    $("#permitted_users").append(
                        '<option value="">No User Found...</option>'
                    );
                } else {
                    $("#permitted_users").append(
                        '<option value="">Select User...</option>'
                    );
                    $.each(data, function (index, data) {
                        $("#permitted_users").append(
                            '<option value="' +
                                data.id +
                                '">' +
                                data.name +
                                "</option>"
                        );
                    });
                }
            },
            error: function (request, status, error) {
                console.log(request);
            },
        });
    });
});

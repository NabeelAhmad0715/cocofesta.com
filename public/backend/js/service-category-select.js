$(document).on("change", ".category-id", function() {
    var category_id = $(this).val();
    var company_id = $("#company_id").val();
    var token = $('meta[name="csrf-token"]').attr("content");
    var url = "/headoffice/category-services/";
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": token
        },
        method: "GET",
        url: url,
        data: {
            category_id: category_id,
            company_id: company_id
        },
        dataType: "json",
        success: function(data) {
            $("#services").empty();
            if (data.length === 0) {
                $("#services").append(
                    '<option value="">No services found in this category</option>'
                );
            } else {
                $("#services").append(
                    '<option value="">None selected</option>'
                );
                $.each(data, function(index, data) {
                    if ($("#old-service-id")) {
                        if ($("#old-service-id").val() == data.id) {
                            $("#services").append(
                                '<option selected value="' +
                                    data.id +
                                    '">' +
                                    data.name +
                                    "</option>"
                            );
                        } else {
                            $("#services").append(
                                '<option value="' +
                                    data.id +
                                    '">' +
                                    data.name +
                                    "</option>"
                            );
                        }
                    } else {
                        $("#services").append(
                            '<option value="' +
                                data.id +
                                '">' +
                                data.name +
                                "</option>"
                        );
                    }
                });
            }
        },
        error: function(request, status, error) {
            console.log(request);
        }
    });
});

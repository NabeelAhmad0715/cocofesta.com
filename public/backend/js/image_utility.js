$(document).ready(function () {
    var targetField;
    var selectedImages = [];
    var targetFieldType;

    $(".image").on("click", imageSelectionHandler);
    $(".trigger-image-utility").on("click", showImageUtility);
    $("#confirm-button").on("click", function (event) {
        $("#image-utility").modal("hide");
    });
    $("#image-utility").on("hidden.bs.modal", function (e) {
        closeImageUtility();
    });
    $("#imageForm").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "/admin/addimage",
            method: "POST",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                var img = $(
                    "" +
                        '<div class="card col-md-3 box"  data-id = "' +
                        data.imageId +
                        '"><img class="modal-image image card-img-top" style="position: relative;" data-id = "' +
                        data.imageId +
                        '" data-name = "' +
                        data.imageName +
                        '" src="/storage/' +
                        data.src +
                        '">\n' +
                        '                                    <p id="resolution" class="resolution"></p>\n' +
                        '                                    <button class="btn btn-danger del-position" data-id = "' +
                        data.imageId +
                        '" data-name = "' +
                        data.imageName +
                        '" onclick="alert(\'Be careful it will remove this image from all places ?\')"><i class="icon-diff-removed"></i></button>\n' +
                        '                                    <div class="card-body p-0 text-center pt-2">\n' +
                        '                                        <p class="card-text">' +
                        data.imageAlt +
                        "</p>\n" +
                        "                                    </div>\n" +
                        "                                </div>"
                );
                $("#imageUpload").prepend(img);
                $(".image").unbind("click", imageSelectionHandler);
                $(".image").on("click", imageSelectionHandler);
                resolution();
                delImage();
            },
            error: function (request, status, error) {
                console.error(request);
            },
        });
    });

    function delImage() {
        $(".del-position").on("click", function (event) {
            event.preventDefault();
            var id = this.dataset.id;
            var name = this.dataset.name;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "/admin/deleteimage",
                method: "POST",
                data: {
                    id: id,
                    name: name,
                },
                dataType: "JSON",
                cache: false,
                success: function (data) {
                    console.log(data);
                    $("div[data-id=" + id + "]").remove();
                    $("#message").css("display", "block");
                    $("#message").html(data.message);
                    $("#message").addClass(data.className);
                },
                error: function (request, status, error) {
                    console.error(request);
                },
            });
        });
    }

    function resolution() {
        $(".image").hover(
            function () {
                var resolution =
                    "W:" +
                    this.naturalWidth +
                    " x " +
                    "H:" +
                    this.naturalHeight;
                $(this).next("p").html(resolution);
            },
            function () {
                $(this).next("p").html("");
            }
        );
    }

    function showImageUtility(event) {
        $("#image-utility").modal("show");
        targetField = $("#" + this.dataset.target);
        targetFieldType = this.dataset.type;
        if (targetField.val()) {
            selectedImages = JSON.parse(targetField.val());
            for (var i = 0; i < selectedImages.length; i++) {
                $("img[data-id=" + selectedImages[i].id + "]").toggleClass(
                    "select"
                );
            }
        }
        resolution();
        delImage();
    }
    function imageSelectionHandler() {
        var id = this.dataset.id;
        var src = this.dataset.name;
        var isFound = false;
        var foundIndex;
        if (targetFieldType == "single") {
            resetImageUtility();
        }
        if (selectedImages.length > 0) {
            for (var i = 0; i < selectedImages.length; i++) {
                if (selectedImages[i].id == id) {
                    isFound = true;
                    foundIndex = i;
                }
            }
        }
        if (isFound) {
            selectedImages.splice(foundIndex, 1);
        } else {
            selectedImages.push({
                id: id,
                name: src,
            });
        }
        $(this).toggleClass("select");
    }
    function closeImageUtility() {
        targetField.val(JSON.stringify(selectedImages));
        resetImageUtility();
    }
    function resetImageUtility() {
        for (var i = 0; i < selectedImages.length; i++) {
            $(".select").toggleClass("select");
        }
        selectedImages = [];
    }
});

$(document).on("focusin", function (event) {
    if ($(event.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});

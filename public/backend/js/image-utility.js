var targetField;
var selectedImages = [];
var imageName = [];
var targetFieldType;

function fetch_data(page, query) {
    var sortBy = $("#search-by").val();
    var sortType = $("#order-by").val();
    $.ajax({
        method: "GET",
        dataType: "JSON",
        url:
            "/admin/pagination/fetch-data?page=" +
                page +
                "&sortby=" +
                sortBy +
                "&sorttype=" +
                sortType +
                "&query=" +
                query +
                "&selection=" +
                JSON.stringify(selectedImages) || null,
        success: function (data) {
            $("#imageUpload").html("");
            $("#imageUpload").html(data);
            $(".image").unbind("click", imageSelectionHandler);
            $(".image").on("click", imageSelectionHandler);
            resolution();
            delImage();
            setSelectedImages();
        },
        error: function (request, status, error) {
            console.error(request);
        },
    });
}

$(".image-filter").on("change", function (e) {
    e.preventDefault();
    var query = $("#searchInput").val();
    var page = $("#hidden_page").val();
    fetch_data(page, query);
});

$("#searchButton").on("click", function (e) {
    e.preventDefault();

    var query = $("#searchInput").val();
    var page = $("#hidden_page").val();
    fetch_data(page, query);
});

$(document).on("click", ".pagination a", function (event) {
    event.preventDefault();
    var query = $("#searchInput").val();
    var page = $(this).attr("href").split("page=")[1];
    fetch_data(page, query);
});

$(".image").on("click", imageSelectionHandler);

$(".trigger-image-utility").on("click", showImageUtility);

$("#confirm-button").on("click", function (event) {
    event.preventDefault();
    targetField.val(JSON.stringify(selectedImages));
    var label = [];
    selectedImages.forEach(function (image) {
        label.push(image.name);
    });
    $("#" + targetField.attr("id") + "-label").html(label.join(", "));
    $("#" + targetField.attr("id") + "-selected").html("");
    label.forEach((image) => {
        $("#" + targetField.attr("id") + "-selected").prepend(
            '<img style="margin-right:20px;height:100px;width:auto;" src="/storage/' +
                image +
                '"/>'
        );
    });

    $("#image-utility").modal("hide");
});

$("#close-button").on("click", function (event) {
    selectedImages = [];
    targetField.val(JSON.stringify(selectedImages));
    $("#" + targetField.attr("id") + "-label").html("");
});

$("#image-utility").on("hidden.bs.modal", function (e) {
    closeImageUtility();
});

$("#imageForm").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
        beforeSend: function () {
            $("#loading-image").css("display", "block");
            $("#uploader").removeClass("active show");
        },
        url: "/admin/upload-image",
        method: "POST",
        data: new FormData(this),
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var img = $(
                '<div class=" col-md-3">' +
                    '<div class=" box modal-image image card-img-top mb-2"data-id="' +
                    data.imageId +
                    '" data-name="' +
                    data.imageName +
                    '"style="background-image: url(/storage/' +
                    data.src +
                    "); position: relative;background-position: center;" +
                    'background-size: cover; background-repeat: no-repeat">' +
                    '<p class="resolution" ></p>' +
                    '<button class="btn btn-danger del-position" data-id="' +
                    data.imageId +
                    '" data-name="' +
                    data.imageName +
                    '" ' +
                    ">" +
                    '<i class="icon-diff-removed"></i></button>' +
                    (data.imageAlt == null
                        ? ""
                        : '<p class="image-text">' + data.imageAlt + "</p>") +
                    "</div>" +
                    "</div>"
            );
            $(".filename").html("No file selected");
            $("#imageForm")[0].reset();
            $("#imageUpload").prepend(img);
            $(".image").unbind("click", imageSelectionHandler);
            $(".image").on("click", imageSelectionHandler);
            resolution();
            delImage();
        },
        complete: function () {
            $("#loading-image").css("display", "none");
            $("#image-upload-message")
                .css("display", "block")
                .delay(2000)
                .slideUp(300);
            $("#uploader").addClass("active show");
        },
        error: function (request, status, error) {
            console.error(request);
        },
    });
});

function delImage() {
    $(".del-position").on("click", function (event) {
        event.preventDefault();
        if (confirm("Be careful it will remove this image from all places ?")) {
            var id = this.dataset.id;
            var name = this.dataset.name;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "/admin/delete-image",
                method: "POST",
                data: {
                    id: id,
                    name: name,
                },
                dataType: "JSON",
                cache: false,
                success: function (data) {
                    $("div[data-id=" + id + "]").remove();
                    $("#message")
                        .css("display", "block")
                        .delay(2000)
                        .slideUp(300);
                    $("#imageUpload").html("");
                    data.forEach(function (image) {
                        var img = $(
                            '<div class=" col-md-3">' +
                                '<div class=" box modal-image image card-img-top mb-2"data-id="' +
                                image.id +
                                '" data-name="' +
                                image.name +
                                '"style="background-image: url(/storage/' +
                                image.name +
                                '); position: relative;background-position: center;background-size: cover; background-repeat: no-repeat">' +
                                '<p class="resolution" ></p>' +
                                '<button class="btn btn-danger del-position" data-id="' +
                                image.id +
                                '" data-name="' +
                                image.name +
                                '" ' +
                                ">" +
                                '<i class="icon-diff-removed"></i></button>' +
                                (image.alt == null
                                    ? ""
                                    : '<p class="image-text">' +
                                      image.alt +
                                      "</p>") +
                                "</div>" +
                                "</div>"
                        );
                        $("#imageUpload").prepend(img);
                    });
                    $(".image").unbind("click", imageSelectionHandler);
                    $(".image").on("click", imageSelectionHandler);
                    resolution();
                    delImage();
                    setSelectedImages();
                },
                error: function (request, status, error) {
                    console.error(request);
                },
            });
        }
    });
}

function resolution() {
    $(".image").hover(
        function () {
            var imageSrc = this.style.backgroundImage
                .replace(/url\((['"])?(.*?)\1\)/gi, "$2")
                .split(",")[0];
            var image = new Image();
            image.src = imageSrc;
            var resolution = "W:" + image.width + "  " + "H:" + image.height;
            $(this).children("p.resolution").html(resolution);
        },
        function () {
            $(this).children("p.resolution").html("");
        }
    );
}

function showImageUtility(event) {
    $("#image-utility").modal("show");
    targetField = $("#" + this.dataset.target);
    setSelectedImages(this);
    showSelectedImages(this);
    resolution();
    delImage();
}

function setSelectedImages(el) {
    targetField = $("#" + el.dataset.target);
    targetFieldType = el.dataset.type;
    if (targetField.val()) {
        selectedImages = JSON.parse(targetField.val());
        for (var i = 0; i < selectedImages.length; i++) {
            $("div[data-id=" + selectedImages[i].id + "]").toggleClass(
                "select"
            );
        }
    }
}

function showSelectedImages(el) {
    var imageableId = el.dataset.postid;
    var imageableType = el.dataset.class;
    var imageType = el.id;
    var inputId = el.dataset.target;
    targetField = $("#" + el.dataset.target);
    targetFieldType = el.dataset.type;
    if (targetField.val()) {
        var selectedImages = JSON.stringify(targetField.val());
        $.ajax({
            method: "GET",
            dataType: "JSON",
            url:
                "/admin/image-gallery/selected?data=" +
                selectedImages +
                "&imageableType=" +
                imageableType +
                "&imageableId=" +
                imageableId +
                "&imageType=" +
                imageType,
            success: function (data) {
                $("#SelectedImages").html("");
                $("#SelectedImages").html(data);
                deselectImage(el);
            },
            error: function (request, status, error) {
                console.error(request);
            },
        });
    }
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
        imageName.push({
            name: src,
        });
        selectedImages.push({
            id: id,
            name: src,
        });
    }
    $(this).toggleClass("select");
}

function closeImageUtility() {
    resetImageUtility();
}

function resetImageUtility() {
    for (var i = 0; i < selectedImages.length; i++) {
        $(".select").toggleClass("select");
    }
    selectedImages = [];
}

$(document).on("focusin", function (event) {
    if ($(event.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});

function deselectImage(el) {
    var elements = document.getElementsByClassName("deselectImage");
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener("click", function (event) {
            event.preventDefault();
            var imageId = this.dataset.id;
            var imageableType = this.dataset.imageabletype;
            var imageableId = this.dataset.imageableid;
            var imageType = this.dataset.imagetype;

            $.ajax({
                method: "GET",
                dataType: "JSON",
                url:
                    "/admin/image-gallery/image/deselect?imageId=" +
                    imageId +
                    "&imageableType=" +
                    imageableType +
                    "&imageableId=" +
                    imageableId +
                    "&imageType=" +
                    imageType,
                success: function (data) {
                    $("#" + imageId).css("display", "none");
                    targetField = $("#" + el.dataset.target);
                    $("." + el.dataset.target);
                    var hiddenInput = JSON.parse(targetField.val());
                    for (var j = 0; j < hiddenInput.length; j++) {
                        if (hiddenInput[j]["id"] == imageId) {
                            hiddenInput.splice(j, 1);
                            var result = JSON.stringify(hiddenInput);
                            targetField.val(result);
                            selectedImages = JSON.parse(result);
                            $("." + el.dataset.target + imageId).attr(
                                "style",
                                "display: none !important"
                            );
                        }
                    }
                },
                error: function (request, status, error) {
                    console.error(request);
                },
            });
        });
    }
}

var MetaDataForm = document.querySelector("#meta-data-form");
var addAnotherMetaDataBtn = document.querySelector(
    "#add-another-meta-data-btn"
);
var metaDataFormGroup = document.querySelector(".meta-data-form-group");

function updateOptionsCount() {
    var metaDataFormGroups = document.querySelectorAll(".countFields");
    var optionsCount = 1;
    metaDataFormGroups.forEach(function (metaDataFormGroup) {
        metaDataFormGroup.innerHTML = optionsCount + ". ";
        optionsCount++;
    });
}

function attachOptionMinusBtnsEventListeners() {
    var optionMinusBtns = document.querySelectorAll(".option-minus-btn");

    optionMinusBtns.forEach(function (btn) {
        btn.addEventListener("click", removeOptionFormGroup);
    });
}

function removeOptionFormGroup(e) {
    optionMinusBtns = document.querySelectorAll(".option-minus-btn");
    console.log(optionMinusBtns);
    if (optionMinusBtns.length > 1) {
        this.parentNode.parentNode.parentNode.remove();
        metaDataFormGroup = document.querySelector(".meta-data-form-group");
        updateOptionsCount();
    }
}

function generateFields(labelText, inputType, inputName, selectOptions = null) {
    var fields = document.getElementById("fields");
    fields.setAttribute("class", "row meta-data meta-data-form-group");
    fields.setAttribute("style", "margin-bottom:12px");

    var fieldParent = document.createElement("div");
    if (inputName == "field_visible[]") {
        fieldParent.classList.add("col-md-12");
    } else {
        if (inputName == "label_name[]") {
            var legend = document.createElement("legend");
            legend.setAttribute(
                "class",
                "text-uppercase font-size-sm font-weight-bold"
            );

            legend.innerHTML =
                '<span class="countFields"></span> Fill the form below to create a new Field';
        }
        fieldParent.classList.add("col-md-4");
    }
    if (inputName == "field_visible[]") {
        fieldParent.setAttribute("style", "margin-bottom:0px");
    } else {
        fieldParent.setAttribute("style", "margin-bottom:20px");
    }

    var formGroup = document.createElement("div");
    formGroup.classList.add("form-group");
    fieldParent.appendChild(formGroup);

    var label = document.createElement("label");
    label.classList.add("font-weight-semibold");
    label.innerHTML = labelText;
    formGroup.appendChild(label);

    if (
        inputType == "color" ||
        inputType == "text" ||
        inputType == "email" ||
        inputType == "hidden" ||
        inputType == "boolean" ||
        inputType == "date" ||
        inputType == "datetime-local" ||
        inputType == "file" ||
        inputType == "checkbox"
    ) {
        var input = document.createElement("input");
        input.classList.add("form-control", "form-input-styled");
        input.name = inputName;
        input.type = inputType;
        formGroup.appendChild(input);
    } else if (inputType == "select" && selectOptions != null) {
        var select = document.createElement("select");
        select.classList.add("form-control", "form-input-styled");

        select.name = inputName;
        selectOptions.forEach(function (option) {
            var optionElement = document.createElement("option");
            optionElement.value = option.value;
            optionElement.innerHTML = option.text;
            select.appendChild(optionElement);
        });
        formGroup.appendChild(select);
    } else {
        console.error("Input Type not Supported");
    }
    if (inputName == "label_name[]") {
        fields.appendChild(legend);
    }
    fields.appendChild(fieldParent);
}
addAnotherMetaDataBtn.addEventListener("click", function (e) {
    generateFields("Label", "text", "label_name[]");
    generateFields("Field Type", "select", "field_type[]", [
        { value: "", text: "Select Field Type" },
        { value: "text", text: "Text" },
        { value: "email", text: "Email" },
        { value: "hidden", text: "Hidden" },
        { value: "checkbox", text: "Checkbox" },
        { value: "color", text: "Color" },
        { value: "file", text: "File" },
        { value: "date", text: "Date" },
        { value: "datetime-local", text: "Datetime Local" },
        { value: "boolean", text: "Boolean" },
        { value: "textarea", text: "Textarea" },
    ]);
    generateFields("HTML Name", "text", "name[]");
    generateFields("Classes", "text", "classes[]");
    generateFields("Required", "select", "required[]", [
        { value: "0", text: "Select Required If You Want" },
        { value: "1", text: "Required" },
    ]);
    generateFields("Multiple", "select", "multiple[]", [
        { value: "0", text: "Select Multiple If You Want" },
        { value: "1", text: "Multiple" },
    ]);
    generateFields("Visible", "select", "field_visible[]", [
        { value: "0", text: "Not Visible in Table View" },
        { value: "1", text: "Visible in Table View" },
    ]);

    attachOptionMinusBtnsEventListeners();
    updateOptionsCount();
});

attachOptionMinusBtnsEventListeners();
updateOptionsCount();

tinymce.init({
    // force_br_newlines : false,
    // force_p_newlines : false,
    /* replace textarea having class .tinymce with tinymce editor */
    verify_html: false,
    selector: "textarea.tinymce",
    extended_valid_elements: "i[class],span[class]",

    /* theme of the editor */
    theme: "modern",
    skin: "lightgray",

    /* width and height of the editor */
    width: "100%",
    height: 200,

    /* display statusbar */
    statubar: true,

    /* plugin */
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],

    init_instance_callback: function(editor) {
        editor.on("KeyDown", function(e) {
            if (e.keyCode == 27) {
                let editor = tinyMCE.activeEditor;
                const dom = editor.dom;
                const parentBlock = tinyMCE.activeEditor.selection.getSelectedBlocks()[0];
                const containerBlock =
                    parentBlock.parentNode.nodeName == "BODY"
                        ? dom.getParent(parentBlock, dom.isBlock)
                        : dom.getParent(parentBlock.parentNode, dom.isBlock);
                let newBlock = tinyMCE.activeEditor.dom.create("p");
                newBlock.innerHTML = '<br data-mce-bogus="1">';
                dom.insertAfter(newBlock, containerBlock);
                let rng = dom.createRng();
                newBlock.normalize();
                rng.setStart(newBlock, 0);
                rng.setEnd(newBlock, 0);
                editor.selection.setRng(rng);
            }
        });
    },

    file_picker_callback: function(callback, value, meta) {
        if (meta.filetype == "image") {
            $("#upload").trigger("click");
            $("#upload").on("change", function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    callback(e.target.result, {
                        alt: ""
                    });
                };
                reader.readAsDataURL(file);
            });
        }
    },

    // content_css: '../../scripts/bootstrap/css/bootstrap.css,../../style.css,../../css/content-box.css,../../css/image-box.css,../../css/animations.css,../../css/components.css,../../scripts/flexslider/flexslider.css,../../scripts/magnific-popup.css,../../scripts/php/contact-form.css,../../scripts/social.stream.css,../../skin.css,../../scripts/jquery.flipster.min.css,../../scripts/iconsmind/line-icons.min.css',

    /* toolbar */
    toolbar:
        "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    fontsize_formats:
        "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 36pt 48pt 72pt 100pt",
    image_advtab: true,

    /* style */
    style_formats: [
        {
            title: "Headers",
            items: [
                { title: "Header 1", format: "h1" },
                { title: "Header 2", format: "h2" },
                { title: "Header 3", format: "h3" },
                { title: "Header 4", format: "h4" },
                { title: "Header 5", format: "h5" },
                { title: "Header 6", format: "h6" }
            ]
        },
        {
            title: "Inline",
            items: [
                { title: "Bold", icon: "bold", format: "bold" },
                { title: "Italic", icon: "italic", format: "italic" },
                { title: "Underline", icon: "underline", format: "underline" },
                {
                    title: "Strikethrough",
                    icon: "strikethrough",
                    format: "strikethrough"
                },
                {
                    title: "Superscript",
                    icon: "superscript",
                    format: "superscript"
                },
                { title: "Subscript", icon: "subscript", format: "subscript" },
                { title: "Code", icon: "code", format: "code" }
            ]
        },
        {
            title: "Blocks",
            items: [
                { title: "Paragraph", format: "p" },
                { title: "Blockquote", format: "blockquote" },
                { title: "Div", format: "div" },
                { title: "Pre", format: "pre" }
            ]
        },
        {
            title: "Alignment",
            items: [
                { title: "Left", icon: "alignleft", format: "alignleft" },
                { title: "Center", icon: "aligncenter", format: "aligncenter" },
                { title: "Right", icon: "alignright", format: "alignright" },
                {
                    title: "Justify",
                    icon: "alignjustify",
                    format: "alignjustify"
                }
            ]
        }
    ]
});

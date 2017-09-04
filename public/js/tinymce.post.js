tinymce.init({ 
            selector:'textarea',
            plugins: 'link code',
            menubar:false,
            branding: false,
            resize: false,
            statusbar: false,
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignjustify | link' ,
            plugins : "paste",
            paste_remove_styles: true,
        });
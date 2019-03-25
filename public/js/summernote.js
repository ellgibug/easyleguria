$(document).ready(function(){
    $('#summernote').summernote({
        height: 400,
        lang: 'ru-RU',
        toolbar: [
            ['insert', ['link', 'table', 'hr', 'picture' ]],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['misc', ['fullscreen', 'undo', 'redo']]
        ]
    });
});
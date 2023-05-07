document.addEventListener("DOMContentLoaded", () => {
    const themeOptions = document.body.classList.contains("theme-dark")
        ? {
            skin: "oxide-dark",
            content_css: "dark",
        }
        : {
            skin: "oxide",
            content_css: "default",
        }

    tinymce.init({
        selector: "#dom_body",
        toolbar:
            "undo redo | styleselect | bold italic underline | alignleft aligncenter alignright bullist numlist | outdent indent | link media | code preview",
        plugins: "code link preview wordcount media",
        ...themeOptions,
    })
})

$('select[name=view_mode]').on('change', function() {
    let val = $(this).find(':selected').val();
    if (val=="secret") {
        $('#input-secret-code').show();
    } else {
        $('#input-secret-code').hide();
    }
})

flatpickr('.flatpickr-no-config', {
    enableTime: true,
    dateFormat: "Y-m-d H:i", 
})
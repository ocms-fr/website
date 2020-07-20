jQuery(document).ready(function ($) {
    $('#doc-content a:empty[name]').each(function () {
        $(this).attr('href', "#" + $(this).attr('name'))})
})

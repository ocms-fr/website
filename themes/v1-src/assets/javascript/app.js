import * as hljs from "../../../../plugins/sunlab/docs/assets/vendor/highlight/highlight";

/*
 * Needed for October's framework
 */
window.$ = window.jQuery = require('jquery')

 /*
 * Application
 */

/**
 * Init the page
 */
$(document).ready(function () {
    // Activate all animations
    $('body').removeClass('preload')

    // Activate mobile menu
    $('#mobile-menu-toggler').click(() => $('#mobile-menu').toggleClass('hidden block'))

    /**
     * FORUM
     */

    // Handle Markdown preview
    $('#postForm #previewButton').click(
        () =>
        $.request('onPreviewMarkdown', {
            form: '#postForm form',
            success: function (data) {
                this.success(data).done(displayPostPreview)
            }
        })
    )

    // Hide the preview on close click
    $('#postForm #hidePreviewButton').click(hidePostPreview)
});

function displayPostPreview()
{
    $('#previewArea' + ' pre code').map(
        (index, element) =>
        hljs.highlightBlock(element)
    )

    $('#previewArea').toggleClass('z-10 hidden');
}

function hidePostPreview()
{
    $('#previewArea').toggleClass('z-10 hidden');
}

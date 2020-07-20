$(document).ready(function () {
    let anchorSplit = document.location.toString().split('#'),
        anchor = anchorSplit[1],
        urlWithoutAnchor = anchorSplit[0]

    if (anchor === 'non-traduits') {
        document.location.href = urlWithoutAnchor
    }

    $('.dead-link').click(function () {
        let urlToGo = $(this).data('nonTraduit')

        if (localStorage.getItem('go-to-official-doc')) {
            $('#non-traduits .popup-content').first().text('Redirection vers la documentation officielle en cours...')
            document.location.href = urlToGo
        }

        $('#go-to-official-doc').click(function () {
            if ($('#go-to-official-doc-remember').is(":checked")) {
                localStorage.setItem('go-to-official-doc', '1')
            }

            document.location.href = urlToGo
        })
    })
})

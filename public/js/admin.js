
$(document).ready(function() {
    var timeoutID = null;

    function doPostRequest(inputString) {
        $.ajax({
            url: 'admin/search',
            type: 'POST',
            data: {keywords: inputString},
        }).done(function(markup) {
            $('#search-results').html(markup);
            $('#grant-button').removeClass('disabled');
            $('#deny-button').removeClass('disabled');
        });
    }

    $('#search-box').keyup(function() {
        clearTimeout(timeoutID);
        var $target = $(this);
        timeoutID = setTimeout(function() { doPostRequest($target.val()); }, 200);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'admin/search',
        type: 'POST',
        data: {keywords: ''}
    }).done(function(markup) {
        $('#search-results').html(markup);
    });

    $('.list-group').on('click', '.list-group-item', function(e) {
        $.ajax({
            url: 'admin/checkModStatus',
            type: 'POST',
            data: {username: $('.active').html()}
        }).done(function(isMod) {
            updateButtons(isMod);
        });
    });

});

function changePrivileges(action)
{
    var username = $('.active').html();
    $.ajax({
        url: 'admin/changePrivileges',
        type: 'POST',
        data: {username: username, action: action}
    }).done(function() {
        alert("Privileges changes successfully.");
        updateButtons(action == 'add' ? 'y' : 'n');
    });
}

function updateButtons(isMod) {
    if (isMod == 'y') {
        $('#grant-button').addClass('disabled');
        $('#deny-button').removeClass('disabled');
    }
    else {
        $('#grant-button').removeClass('disabled');
        $('#deny-button').addClass('disabled');
    }
}
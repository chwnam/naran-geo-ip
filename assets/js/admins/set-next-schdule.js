/* globals ajaxurl, jQuery, ngipSetNextSchedule */
(function ($) {
    var opts = ngipSetNextSchedule || {nonce: ''}

    $('#ngip-activate-db-schedule').on('click', function () {
        var td = $(this).closest('td');

        $.ajax(ajaxurl, {
            method: 'post',
            data: {
                action: 'ngip_activate_db_schedule',
                nonce: opts.nonce
            },
            success: function (r) {
                if (r.success) {
                    td.html(r.data.html);
                } else if (r.hasOwnProperty('data') && $.isArray(r.data)) {
                    var messages = [];
                    $.each(r.data, function (idx, elem) {
                        messages.push(elem.code + ': ' + elem.message);
                    });
                    alert(messages.join('\n'));
                } else {
                    console.log(r);
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert(jqXhr.status + ': ' + errorThrown);
            }
        })
    });
})(jQuery);
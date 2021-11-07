/* globals jQuery, ngipIpTester */
(function ($) {
    var opts = ngipIpTester || {nonce: ''},
        button = $('#ngip-test-ip-query'),
        input = $('#ngip-test-ip-input'),
        result = $('#ngip-ip-test-result'),
        template = wp.template('settings-ip-test-ejs');

    button.on('click', function () {
        var ip = input.val().trim();

        if (ip.length) {
            wp.ajax.send('ngip_query_ip_address', {
                method: 'get',
                data: {
                    action: 'ngip_query_ip_address',
                    nonce: opts.nonce,
                    ip: ip
                },
                beforeSend: function () {
                    button.attr('disabled', 'disabled');
                },
                success: function (data) {
                    result.html(template(data));
                },
                error: function (data, textStatus, errorThrown) {
                    if ($.isArray(data)) {
                        alert('[Error] ' + data[0].code + ': ' + data[0].message);
                    } else if ($.isPlainObject(data)) {
                        alert(data.status + ': ' + errorThrown);
                    } else {
                        console.log(data);
                    }
                },
                complete: function () {
                    button.removeAttr('disabled');
                }
            });
        }
    });
})(jQuery);

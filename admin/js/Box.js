var Box = (function (w, $, undefined) {

    var options = {
        type: 'small',
        color: '#739E73',
        icon: 'fa fa-check'
    };

    function show() {
        $[options.type+'Box'](options);
    }

    function showIfHash(hash) {
        if (location.hash == '#'+hash) {
            show();
            location.hash = '';
        }
    }

    return {
        big: function (texts) {
            options.title = texts.title || '';
            options.content = texts.content || '';
            options.type = 'big';
            return this;
        },
        small: function (texts) {
            options.title = texts.title || '';
            options.content = texts.content || '';
            options.type = 'small';
            return this;
        },
        error: function () {
            options.color = '#C46A69';
            options.icon = 'fa fa-warning';
            return this;
        },
        info: function () {
            options.color = '#3276B1';
            options.icon = 'fa fa-bell';
            options.timeout = 2500;
            return this;
        },
        warning: function () {
            options.color = '#C79121';
            options.icon = 'fa fa-warning';
            options.timeout = 3500;
            return this;
        },
        success: function () {
            options.color = '#739E73';
            options.icon = 'fa fa-check';
            options.timeout = 2500;
            return this;
        },
        show: function () {
            show();
        },
        showIfHash: function (hash) {
            showIfHash(hash);
        }
    }

})(window, jQuery);
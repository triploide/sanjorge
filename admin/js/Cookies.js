var Cookie = (function (w, $, undefined) {

    function set(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function get(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function erase(name) {
        createCookie(name, "", -1);
    }

    return {
        get: function (name, value, day) {
            get(name, value, days);
        },
        set: function (name) {
            set(name);
        },
        erase: function (name) {
            erase(name);
        }
    }

})(window, jQuery);
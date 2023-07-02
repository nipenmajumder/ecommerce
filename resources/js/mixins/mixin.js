export default {
    data() {
        return {
            isLoading: false,
        };
    },
    methods: {
        routeName(name) {
            return route(name);
        },
        newTab(url) {
            window.open(url, '_blank');
        },
        slugify: function (text) {
            let slug = '';
            let titleLower = text.toLowerCase();
            slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
            slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
            slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
            slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
            slug = slug.replace(/đ/gi, 'd');
            slug = slug.replace(/\s*$/g, '');
            slug = slug.replace(/\s+/g, '-');
            slug = slug.replace("'", '');
            slug = slug.replace(/[^a-zA-Z ]/g, '-');
            return slug;
        },
        reload(time) {
            setTimeout(() => {
                window.location.reload();
            }, time);
        },
        capitalize(event) {
            return event.target.value.replace(/(?:^|\s)\S/g, function (a) {
                return a.toUpperCase();
            });
        },
        playSound: function () {
            let sound = '/audio/error.mp3';
            let audio = new Audio(sound);
            audio.play();
        },
        formReset: function (form) {
            Object.keys(form).forEach(function (key, index) {
                form[key] = '';
            });
        },
        objectArrayReset: function (form) {
            Object.keys(form).forEach(function (key, index) {
                form[key] = [];
            });
        },
        loader: function (loader) {
            const appLoader = $('#loader');
            const layouts = $('#layouts');
            if (loader === true) {
                appLoader.show();
                layouts.show();
            } else if (loader === false) {
                appLoader.hide();
                layouts.hide();
            } else {
                appLoader.show();
                layouts.show();
                setTimeout(() => {
                    appLoader.hide();
                    layouts.hide();
                }, 500);
            }
        },
        scrollToTop: function () {
            window.scrollTo(0, 0);
        },
        redirectTo: function (route) {
            window.location.href = route;
        }
    }
};

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('ucenter.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/vendor/ucenter/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/vendor/ucenter/AdminLTE/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/vendor/ucenter/AdminLTE/plugins/glyphicon/glyphicon.css">
    <link rel="stylesheet" href="/vendor/ucenter/AdminLTE/plugins/toastr/toastr.css">
    <link href="https://s2.pstatp.com/cdn/expire-1-M/nprogress/0.2.0/nprogress.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="/vendor/ucenter/select2/dist/css/select2.min.css">
    <link href="https://s1.pstatp.com/cdn/expire-1-M/bootstrap-sweetalert/1.0.1/sweetalert.min.css" type="text/css" rel="stylesheet" />
    @yield('css')
</head>
<style>
    #totop{display:none;position:fixed;bottom:40px;right:20px;z-index:99999;outline:none;background-color:rgb(34,45,50);color:rgb(238,238,238);cursor:pointer;padding:10px 15px;border-radius:4px;opacity:.5}#totop:hover{opacity:1}
</style>
<body class="sidebar-mini control-sidebar-slide-open textmenu-open-sm" style="height: auto;font-size: 14px;">

@if($alert = config('ucenter.top_alert'))
    <div style="text-align: center;padding: 5px;font-size: 12px;background-color: #ffffd5;color: #ff0000;">
        {!! $alert !!}
    </div>
@endif

<div class="wrapper">
    @include('ucenter::partials.header')
    @include('ucenter::partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <div id="app">
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('ucenter::partials.footer')
    <!-- Control Sidebar -->
{{--    <aside class="control-sidebar control-sidebar-dark">--}}
{{--        <!-- Control sidebar content goes here -->--}}
{{--    </aside>--}}
    <!-- /.control-sidebar -->
</div>
<button id="totop" title="Go to top" style="display: none;"><i class="fa fa-chevron-up"></i></button>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/vendor/ucenter/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/vendor/ucenter/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.js"></script>
<script src="/vendor/ucenter/AdminLTE/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/vendor/ucenter/AdminLTE/dist/js/adminlte.min.js"></script>
<script src="/vendor/ucenter/AdminLTE/plugins/toastr/toastr.min.js"></script>
<script src="https://s1.pstatp.com/cdn/expire-1-M/jquery.pjax/2.0.1/jquery.pjax.min.js" type="application/javascript"></script>
<script src="https://s1.pstatp.com/cdn/expire-1-M/nprogress/0.2.0/nprogress.min.js" type="application/javascript"></script>
<script src="/vendor/ucenter/select2/dist/js/select2.min.js"></script>
<script src="https://s0.pstatp.com/cdn/expire-1-M/sweetalert/2.1.2/sweetalert.min.js" type="application/javascript"></script>
<script>
    function LA() {}
    LA.token = "{{csrf_token()}}";

    // $.fn.editable.defaults.params = function (params) {
    //     params._token = LA.token;
    //     params._editable = 1;
    //     params._method = 'PUT';
    //     return params;
    // };
    //
    // $.fn.editable.defaults.error = function (data) {
    //     var msg = '';
    //     if (data.responseJSON.errors) {
    //         $.each(data.responseJSON.errors, function (k, v) {
    //             msg += v + "\n";
    //         });
    //     }
    //     return msg
    // };

    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };

    $.pjax.defaults.timeout = 5000;
    $.pjax.defaults.maxCacheLength = 0;
    $(document).pjax('a:not(a[target="_blank"])', {
        container: '#pjax-container'
    });

    NProgress.configure({parent: '#app'});

    $(document).on('pjax:timeout', function (event) {
        event.preventDefault();
    })

    $(document).on('submit', 'form[pjax-container]', function (event) {
        $.pjax.submit(event, '#pjax-container')
    });

    $(document).on("pjax:popstate", function () {

        $(document).one("pjax:end", function (event) {
            $(event.target).find("script[data-exec-on-popstate]").each(function () {
                $.globalEval(this.text || this.textContent || this.innerHTML || '');
            });
        });
    });

    $(document).on('pjax:send', function (xhr) {
        if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
            $submit_btn = $('form[pjax-container] :submit');
            if ($submit_btn) {
                $submit_btn.button('loading')
            }
        }
        NProgress.start();
    });

    $(document).on('pjax:complete', function (xhr) {
        if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
            $submit_btn = $('form[pjax-container] :submit');
            if ($submit_btn) {
                $submit_btn.button('reset')
            }
        }
        NProgress.done();
        $.admin.grid.selects = {};
        init();
    });

    $(document).click(function () {
        $('.sidebar-form .dropdown-menu').hide();
    });

    $(function () {
        $('.sidebar-menu li:not(.treeview) > a').on('click', function () {
            var $parent = $(this).parent().addClass('active');
            $parent.siblings('.treeview.active').find('> a').trigger('click');
            $parent.siblings().removeClass('active').find('li').removeClass('active');
        });
        var menu = $('.sidebar-menu li > a[href$="' + (location.pathname + location.search + location.hash) + '"]').addClass('active');
        menu.parents('ul.treeview-menu').addClass('menu-open');
        menu.parents('li.treeview').addClass('active menu-is-opening menu-open');

        $('[data-toggle="popover"]').popover();

        // Sidebar form autocomplete
        $('.sidebar-form .autocomplete').on('keyup focus', function () {
            var $menu = $('.sidebar-form .dropdown-menu');
            var text = $(this).val();

            if (text === '') {
                $menu.hide();
                return;
            }

            var regex = new RegExp(text, 'i');
            var matched = false;

            $menu.find('li').each(function () {
                if (!regex.test($(this).find('a').text())) {
                    $(this).hide();
                } else {
                    $(this).show();
                    matched = true;
                }
            });

            if (matched) {
                $menu.show();
            }
        }).click(function(event){
            event.stopPropagation();
        });

        $('.sidebar-form .dropdown-menu li a').click(function (){
            $('.sidebar-form .autocomplete').val($(this).text());
        });
    });

    $(window).scroll(function() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            $('#totop').fadeIn(500);
        } else {
            $('#totop').fadeOut(500);
        }
    });

    $('#totop').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({scrollTop: 0}, 500);
    });

    (function ($) {

        var Grid = function () {
            this.selects = {};
        };

        Grid.prototype.select = function (id) {
            this.selects[id] = id;
        };

        Grid.prototype.unselect = function (id) {
            delete this.selects[id];
        };

        Grid.prototype.selected = function () {
            var rows = [];
            $.each(this.selects, function (key, val) {
                rows.push(key);
            });

            return rows;
        };

        $.fn.admin = LA;
        $.admin = LA;
        // $.admin.swal = swal;
        $.admin.toastr = toastr;
        $.admin.grid = new Grid();

        $.admin.reload = function () {
            $.pjax.reload('#pjax-container');
            $.admin.grid = new Grid();
        };

        $.admin.redirect = function (url) {
            $.pjax({container:'#pjax-container', url: url });
            $.admin.grid = new Grid();
        };

        $.admin.getToken = function () {
            return $('meta[name="csrf-token"]').attr('content');
        };

        $.admin.loadedScripts = [];

        $.admin.loadScripts = function(arr) {
            var _arr = $.map(arr, function(src) {

                if ($.inArray(src, $.admin.loadedScripts)) {
                    return;
                }

                $.admin.loadedScripts.push(src);

                return $.getScript(src);
            });

            _arr.push($.Deferred(function(deferred){
                $(deferred.resolve);
            }));

            return $.when.apply($, _arr);
        }

    })(jQuery);
    function initSelect2(){
        var select2 = $(".select2");
        if (select2 != null){
            select2.select2({
                placeholder: "Select a state",
                allowClear: true,
            });
        }
    }
    function init(){
        initSelect2();
    }
    $(document).ready(function() {
        init();
    });
</script>
@yield('script')
</body>
</html>

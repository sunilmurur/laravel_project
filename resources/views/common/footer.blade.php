<script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}"></script> 
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

<script type="text/javascript" src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/popper.js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('js/modernizr/modernizr.js') }}"></script>
<!-- am chart -->
<script src="{{ asset('pages/widget/amchart/amcharts.min.js') }}"></script>
<script src="{{ asset('pages/widget/amchart/serial.min.js') }}"></script>
<!-- Todo js -->
<script type="text/javascript " src="{{ asset('pages/todo/todo.js') }} "></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('pages/dashboard/custom-dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script type="text/javascript " src="{{ asset('js/SmoothScroll.js') }}"></script>
<script src="{{ asset('js/pcoded.min.js') }}"></script>
<script src="{{ asset('js/demo-12.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script>
var $window = $(window);
var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
         nav.addClass('active');
     }
     else {
         nav.removeClass('active');
     }
 });
</script>
@stack('scripts')
</body>

</html>

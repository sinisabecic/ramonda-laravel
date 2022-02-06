<!-- Side widget-->
{{--<div class="card mb-4">--}}
{{--    <div class="card-header">Side Widget</div>--}}
{{--    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use,--}}
{{--        and feature the Bootstrap 5 card component!--}}
{{--    </div>--}}
{{--</div>--}}
</div>

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright
            &copy; {{ env('APP_NAME') }} {{ \Carbon\Carbon::createFromDate()->format('Y.') }}</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
{{--<script src="js/scripts.js"></script>--}}
@yield('script')
</body>
</html>

<html>

@include('template/call_head')

<body class="sidebar-mini" style="height: auto;">
	<div class="wrapper">
        @include('template/navbar')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" style="min-height: 1592px;">

            @include('template/page_header')

			<!-- Main content -->
		    <section class="content">

                @include('template/page_konten')

		    </section>
		    <!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		@include('template/call_footer')
	</div>

    @include('template/call_js')

    @yield('script_custom')
</body>
</html>

<!doctype html>
<html lang="en" 
    class="layout-navbar-fixed layout-menu-fixed layout-compact" 
    dir="ltr" data-skin="default" data-bs-theme="light"
    data-assets-path="{{ asset('portos/assets') }}" 
    data-template="vertical-menu-template-semi-dark">

    @include('layouts.head')
	
	<body>
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden"></iframe>
		</noscript>
		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar  ">
			<div class="layout-container">
				
                @include('layouts.sidebar')

				<!-- Layout container -->
				<div class="layout-page">
					
                    @include('layouts.navbar')

					@yield('content')
				</div>
				<!-- / Layout page -->
			</div>
			<!-- Overlay -->
			<div class="layout-overlay layout-menu-toggle"></div>
            
			<!-- Drag Target Area To SlideIn Menu On Small Screens -->
			<div class="drag-target"></div>
		</div>
		
        @include('layouts.scripts')
	</body>
</html>
<!-- beautify ignore:end -->
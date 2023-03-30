@include('includes.emails.header')
<div class="email-body">
    @yield('content')
</div>
@include('includes.emails.footer')
@yield('footerjs')
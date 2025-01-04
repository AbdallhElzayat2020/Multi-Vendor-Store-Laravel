<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>

    @include('layouts.header')

    @include('layouts.sidebar')

    <main id="main" class="main">

        {{-- breadcrumb --}}
        @yield('breadcrumb')
        {{-- breadcrumb --}}


        @yield('content')

    </main>
    <!-- End #main -->

    @include('layouts.footer')

    @include('layouts.scripts')

</body>

</html>

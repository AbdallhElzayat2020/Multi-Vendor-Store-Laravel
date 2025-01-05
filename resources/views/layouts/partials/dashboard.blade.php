<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.head')

<body>

    @include('layouts.partials.header')

    @include('layouts.partials.sidebar')

    <main id="main" class="main">

        {{-- breadcrumb --}}
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>

        {{-- breadcrumb --}}


        @yield('content')

    </main>
    <!-- End #main -->

    @include('layouts.partials.footer')

    @include('layouts.partials.scripts')


</body>

</html>

<main id="main" class="main">
    @hasSection('page-title')
        <div class="pagetitle">
            <h1>@yield('page-title')</h1>
            @hasSection('breadcrumbs')
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        @yield('breadcrumbs')
                    </ol>
                </nav>
            @endif
        </div>
    @endif
    <section class="section">
        @yield('content')
    </section>
</main>

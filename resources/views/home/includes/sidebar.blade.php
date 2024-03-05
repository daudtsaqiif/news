    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            {{-- home --}}
            <li class="nav-item">
                <a class="nav-link " href="{{ route('home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Home</span>
                </a>
            </li>

            @if (Auth::user()->role == 'admin')
                {{-- cstegory & news --}}
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('category.index') }}">
                        <i class="bi bi-basket2"></i>
                        <span>category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('news.index') }}">
                        <i class="bi bi-basket2"></i>
                        <span>News</span>
                    </a>
                </li>
                
            @else
            @endif
        </ul>

    </aside><!-- End Sidebar-->

<nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
    <script>
        var navbarStyle = localStorage.getItem("phoenixNavbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">
                <!-- parent pages-->
                <span class="nav-item-wrapper">
                    <a class="nav-link label-1 {{Request::url() == route('dashboard')  ? 'active':''}}  " href="{{ route('dashboard') }}" role="button"  >
                    <div class="d-flex align-items-center"><div class="dropdown-indicator-icon">
                    </div><span class="nav-link-icon"><i class="fa-solid fa-home mt-1"></i></span><span class="nav-link-text">Home</span>
                </div></a>
            </span>
            </li>
            @if (Auth::user()->can('view-all-tasks'))
            <li class="nav-item">
            <!-- parent pages-->
            <span class="nav-item-wrapper">
                <a class="nav-link label-1 {{Request::url() == route('employee.index') ? 'active':''}}" href="{{ route('employee.index') }}" role="button"  >
                <div class="d-flex align-items-center"><div class="dropdown-indicator-icon">
                </div><span class="nav-link-icon"><i class="fa-solid fa-table mt-1"></i></span><span class="nav-link-text">Employee Page</span>
            </div></a>
        </span>
        </li>

        <li class="nav-item">
            <!-- parent pages-->
            <span class="nav-item-wrapper">
                <a class="nav-link label-1 {{Request::url() == route('departments.index') ? 'active':''}} " href="{{ route('departments.index') }}" role="button"  >
                <div class="d-flex align-items-center"><div class="dropdown-indicator-icon">
                </div><span class="nav-link-icon"><i class="fa-solid fa-table mt-1"></i></span><span class="nav-link-text">Departments Page</span>
            </div></a>
        </span>
        </li>

        <li class="nav-item">
            <!-- parent pages-->
            <span class="nav-item-wrapper">
                <a class="nav-link label-1 {{Request::url() == route('tasks.index')? 'active':''}}" href="{{ route('tasks.index') }}" role="button"  >
                <div class="d-flex align-items-center"><div class="dropdown-indicator-icon">
                </div><span class="nav-link-icon"><i class="fa-solid fa-table mt-1"></i></span><span class="nav-link-text">Tasks Page</span>
            </div></a>
        </span>
        </li>
        @endif
        @if (Auth::user()->can('view-assigned-tasks'))

        <li class="nav-item">
            <!-- parent pages-->
            <span class="nav-item-wrapper">
                <a class="nav-link label-1 {{Request::url() == route('employeeTasks.index')? 'active':''}}" href="{{ route('employeeTasks.index') }}" role="button"  >
                <div class="d-flex align-items-center"><div class="dropdown-indicator-icon">
                </div><span class="nav-link-icon"><i class="fa-solid fa-table mt-1"></i></span><span class="nav-link-text">Tasks Page</span>
            </div></a>
        </span>
        </li>
        @endif

     




        </ul>
</div>
</div>
<div class="navbar-vertical-footer"><button onclick="toggleNavArrow()" class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 text-start white-space-nowrap"><span id="toggleArrow" class="fas fa-arrow-right d-none fs-0"></span><span class="navbar-vertical-footer-text ms-2"> <span class="fas fa-arrow-left  ms-2"></span> Collapsed View </span></span></button></div>
</nav>

<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory"
                aria-expanded="false" aria-controls="collapseCategory">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Category
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseCategory" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('categories.create') }}">Create Category</a>
                    <a class="nav-link" href="{{ route('categories.index') }}">View Category</a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                data-bs-target="#collapseProductsRecommended" aria-expanded="false"
                aria-controls="collapseProductsRecommended">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Family Packages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProductsRecommended" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('recommended.create') }}">Create Recommended Product</a>
                    <a class="nav-link" href="{{ route('recommended.index') }}">View Recommended Products</a>
                </nav>
            </div>

            <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductsSingle"
                aria-expanded="false" aria-controls="collapseProductsSingle">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Single Item Groceries
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProductsSingle" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('single-products.create') }}">Create Single Item Product</a>
                    <a class="nav-link" href="{{ route('single-products.index') }}">View Single Item Product</a>
                </nav>
            </div>

            <div class="sb-sidenav-menu-heading">Track Orders</div>
            <a class="nav-link" href="{{ route('deliveries.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Delivered
            </a>
            <a class="nav-link" href="{{ route('orders.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Orders
            </a>

            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </div>
    </div>
</nav>
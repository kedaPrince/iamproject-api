<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="index.html">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapeCategory"
                aria-expanded="false" aria-controls="collapeCategory">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Category
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapeCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('/categories-create') }}">Create Category</a>
                    <a class="nav-link" href="{{ url('/view-categories') }}">View Category</a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                data-bs-target="#collapseProductsRecommended" aria-expanded="false"
                aria-controls="collapseProductsRecommended">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Family Packages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProductsRecommended" aria-labelledby="headingOne"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('/products-create') }}">Create Recommended Products</a>
                    <a class="nav-link" href="{{ url('/view-products') }}">View Recommended Product</a>
                </nav>
            </div>

            <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductsSingle"
                aria-expanded="false" aria-controls="collapseProductsSingle">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Single Item Groceries
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseProductsSingle" aria-labelledby="headingOne"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('/single-product-create') }}">Create Single Item Product</a>
                    <a class="nav-link" href="{{ url('/view-single-product') }}">View Single Item Product</a>
                </nav>
            </div>

            <div class="sb-sidenav-menu-heading">Track Orders</div>
            <a class="nav-link" href="{{url('/deliveries')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Delivered
            </a>
            <a class="nav-link" href="{{url('/orders')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Orders
            </a>


</nav>
</div>
<div class="sb-sidenav-menu-heading">Addons</div>
<a class="nav-link" href="charts.html">
    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
    Charts
</a>
<a class="nav-link" href="tables.html">
    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
    Tables
</a>
</div>
</div>
<div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    Start Bootstrap
</div>
</nav>
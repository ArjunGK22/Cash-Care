<x-layout>

    <x-sidebar>
        <h2>Admin Dashboard</h2>

        {{-- bread cumbs  --}}
        <div class="card p-3 shadow">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        {{-- cards --}}

        <div class="row mt-5">
            <div class="col">
                <div class="card text-white" style="background-color: #007F73">
                    <div class="d-flex align-items-center gap-3 p-4">
                        <i class="bi bi-cash-coin fs-1 text-white"></i>
                        <div>
                            <span class="fs-2">1</span>
                            <h4 class="fs-4">Amount Disbursed</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white" style="background-color: #007F73">
                    <div class="d-flex align-items-center gap-3 p-4">
                        <i class="bi bi-file-earmark-ppt-fill fs-1"></i>
                        <div>
                            <span class="fs-2">2</span>
                            <h4 class="fs-4">Pending Applications</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white" style="background-color: #007F73">
                    <div class="d-flex align-items-center gap-3 p-4">
                        <i class="bi bi-people fs-1"></i>
                        <div>
                            <span class="fs-2">2</span>
                            <h4 class="fs-4">Total Lenders</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </x-sidebar>
</x-layout>

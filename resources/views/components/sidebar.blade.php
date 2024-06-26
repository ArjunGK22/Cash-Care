<div class="container-fluid" id="sidebar">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #007F73">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/"
                    class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-3 text-center d-none d-sm-inline"><i class="bi bi-coin fs-3 me-2"></i>Cash-Care</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start text-white"
                    id="menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-people-fill"></i> <span class="ms-1 d-none d-sm-inline">Employees</span><i class="bi bi-caret-down-fill ms-2"></i>
                        </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="{{ route('employees.index')}}" class="nav-link px-0 ms-4"> <span class="d-none d-sm-inline">View
                                        Employees</span> </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi bi-cash-stack"></i> <span class="ms-1 d-none d-sm-inline">Loan</span><i class="bi bi-caret-down-fill ms-2"></i></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li>
                                <a href="{{route('loans.index')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">
                                        Active Loans</span></a>
                            </li>
                            <li class="w-100">
                                <a href="{{ route('repayment.index')}}" class="nav-link px-0"> <span
                                        class="d-none d-sm-inline">Repayment</span></a>
                            </li>
                            <li>
                                <a href="{{ route('status.index') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">Pending
                                        Applications</a>
                            </li>
                            <li>
                                <a href="{{ route('loans.closed') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">Closed
                                        Applications</a>
                            </li>

                        </ul>
                    </li>
                    
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                            class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">Hello Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                       
                        <li><a class="dropdown-item" href="/logout">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">

            {{ $slot }}
        </div>
    </div>
</div>

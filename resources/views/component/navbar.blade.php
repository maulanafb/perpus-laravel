<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

    <div class="container-fluid">
        <div class="collapse" id="search-nav">
            <form class="navbar-left navbar-form nav-search mr-md-3">
                <h3 class="text-light" style="">PERPUSTAKAAN SMK AL-MADANI PONTIANAK</h3>

            </form>
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                    aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
            </li>
           
        
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="../assets/img/userr.png" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}" id="logout-link">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>

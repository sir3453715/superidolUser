<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom sticky">
    <div class="container">
        <a class="navbar-brand logo" href="#">
            <i class="mdi mdi-chart-donut-variant"></i>
            超級集團CRM系統
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto" >
                @if(\Request::route()->getName() == 'template')
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Select2">Select2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Slider">Slider</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Editor">Editor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Popup">Popup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Form">Form Validation</a>
                </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="form-inline">
                            <span class="mr-3"> Hi! {{ \Illuminate\Support\Facades\Auth::user()->name  }}</span>
                            <button class="nav-link btn btn-sm text-danger">登出</button>
                        </div>
                    </form>
                </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('login')}}">登入</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- NAVBAR END-->

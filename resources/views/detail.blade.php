<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>GIS #2</title>

    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.3/dist/leaflet.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.3/dist/leaflet.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.1/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.1/MarkerCluster.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.1/MarkerCluster.Default.css" />

    <!--JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!-- Boostrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('Admin Marker Hospital') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

            <div class="card">
            <div class="card-header text-center">
                <h2 style="text-transform:uppercase">{{ $rumahsakits->name }}</h2>
            </div>
            <div class="card-body">
                <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="{{ asset('foto/rumahsakit/'.$rumahsakits->thumbnail_name) }}" class="d-block w-100" alt="thumbnail">
                    </div>
                    <div class="carousel-item">
                    <img src="{{ asset('background-detail.jpeg') }}" class="d-block w-100" alt="image">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div>
            <div class="card-footer text-body-secondary">
                <h4 class="text-center">Layanan</h4>
            </div>
            <div class="card-body">
                <div class="container text-center">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    @foreach ( $rumahsakits->layanans as $data )
                    <div class="col">
                        <div class="card" style="width: 18rem; min-height:400px pb-2">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $data->name }}</h5>
                            <div class="d-flex flex-row align-items-center">
                                <div class="p-1" style="font-size:12px">Type : {{ $data->type->name }}</div>
                                <div class="p-1" style="font-size:12px">Operational :{{ $data->operational }}</div>
                            </div>
                        </div>
                        <img class="card-img-top" src="{{ asset($data->image_name) }}" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">{{ $data->description }}</p>
                            <a href="#" class="btn btn-primary">Doctor Schedule</a>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-body-secondary mt-5">
                <h4 class="text-center">Ruangan</h4>
            </div>
            <div class="card-body">
                <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @foreach ( $rumahsakits->rooms as $room )
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-6 layanan-image">
                            <img src="{{ asset($room->thumbnail_name) }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-text text-center">{{ $room->name }}</h5>
                                <p class="card-text mb-0">Tipe &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;: {{ $room->type }}</p>
                                <p class="card-text mb-0">Kunjungan &nbsp; : {{ $room->visiting_hours }}</p>
                                <p class="card-text mb-0 pb-1 border-bottom border-3">Kapasitas &nbsp;&nbsp;&nbsp;&nbsp;: {{ $room->capacity }}</p>
                                @if ($room->type == 'Reguler')
                                    <p class="card-text mb-0 text-center fw-bold">Fasilitas</p>
                                    <p class="card-text mb-0 text-center"> Sharing room, 1 TV, 2 Kipas Angin, 1 Toilet, Single bed</p>
                                @elseif ($room->type == 'VIP')
                                    <p class="card-text mb-0 text-center fw-bold">Fasilitas</p>
                                    <p class="card-text mb-0 text-center"> Private room, 1 Led TV, 1 AC, 1 Toilet, Soft bed, Share Wifi</p>
                                @else
                                    <p class="card-text mb-0 text-center fw-bold">Fasilitas</p>
                                    <p class="card-text mb-0 text-center"> Private room, 1 Smart TV, 1 AC, 1 Toilet, Soft bed, Private Wifi</p>
                                @endif
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

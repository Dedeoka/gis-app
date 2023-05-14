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
    @include('sweetalert::alert')
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
    <div class="map" id="map"></div>

    <!-- Modal create -->
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Add Hospital Marker
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/map" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                <div class="col mb-1">
                  <label for="latitude" class="col-form-label">Latitude</label>
                  <input type="text" class="form-control form-control-sm" id="latitude" name="latitude" readonly />
                </div>
                <div class="col mb-1">
                  <label for="longtitude" class="col-form-label">Longtitude</label>
                  <input type="text" class="form-control form-control-sm" id="longitude" name="longitude" readonly/>
                </div>
              </div>
              <div class="mb-1">
                <label for="name" class="col-form-label">Name</label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name..." required autofocus />
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-1">
                <label for="type" class="col-form-label">Tipe Rumah Sakit</label>
                <select class="form-control costume-form-input @error('type') is-invalid @enderror" id="type" name="type" aria-placeholder="type" >
                    <option value="" selected disabled hidden>Type</option>
                    <option value="Rumah sakit umum">Rumah Sakit Umum</option>
                    <option value="Rumah sakit swasta">Rumah Sakit Swatsa</option>
                    <option value="Rumah sakit khusus">Rumah Sakit Khusus</option>
                </select>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-1">
                <label for="kelas" class="col-form-label">Kelas Rumah Sakit</label>
                <select class="form-control costume-form-input @error('kelas') is-invalid @enderror" id="kelas" name="kelas" aria-placeholder="kelas" >
                    <option value="" selected disabled hidden>Kelas</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
                @error('kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-1">
                <label for="email" class="col-form-label">Email</label>
                <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email..." required />
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-1">
                <label for="phone" class="col-form-label">Phone</label>
                <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Phone..." required />
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-1">
                <label for="operational" class="col-form-label">Jam Oprasional</label>
                <input type="text" class="form-control form-control-sm @error('operational') is-invalid @enderror" id="operational" name="operational" placeholder="24 jam..." required />
                @error('operational')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-1">
                <label for="address" class="col-form-label">Address</label>
                <input class="form-control form-control-sm @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address..."required></input>
                @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-1">
                <label for="description" class="col-form-label">Description</label>
                <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description..."required></textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-container">
                <div class="form-group px-3">
                <label for="thumbnail_name">Thumbnail Rumah Sakit</label>
                <input type="file" name="thumbnail_name" id="thumbnail_name" class="form-control costume-form-file @error('thumbnail_name') is-invalid @enderror" value="{{ old('thumbnail_name') }}">
                @error('thumbnail_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="modal-footer mt-3">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Leaflet -->
    <script>
      var map = L.map('map').setView([-8.67797280986823, 115.22417764538248], 12)

      L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      }).addTo(map);

      var markerIcon = L.icon({
        iconUrl: "marker.png",
        iconSize: [30, 30],
        popupAnchor: [0, -30],
      });

      var cluster = L.markerClusterGroup();


      @foreach ($data as $item)
        var mark = cluster.addLayer(L.marker([{{ $item->latitude }},{{ $item->longitude }}], {icon: markerIcon}))
        .on('click', function(e) {
            window.location.href = "{{ url('map', ['id' => $item->id]) }}";
        });

      @endforeach

      map.addLayer(cluster);

      var marker;

      var latitude = document.getElementById("latitude");
      var longitude = document.getElementById("longitude");
      function onMapClick(e) {
        marker = new L.marker(e.latlng, {
          icon: markerIcon,
        }).addTo(map);
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (!marker) {
          marker = L.marker(e.latlng).addTo(map);
        } else {
          marker.setLatLng(e.latlng);
        }

        latitude.value = lat;
        longitude.value = lng;

        $("#modalCreate").modal("show");
      }

      map.on("click", onMapClick);

      $('#modalCreate').on('hidden.bs.modal', function () {
        map.removeLayer(marker)
      })
    </script>
  </body>
</html>

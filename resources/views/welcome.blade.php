<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>GIS #2</title>

    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <!--JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!-- Boostrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    @include('sweetalert::alert')
    <h3 class="title">Add Marker Hospital Map With Leaflet</h3>
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
                <label for="email" class="col-form-label">Email</label>
                <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" placeholder="email..." required />
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

      @foreach ($spaces as $item)
        L.marker([{{ $item->latitude }},{{ $item->longitude }}], {icon: markerIcon,})
          .bindPopup(
          `
            <div class="" style="width: 18rem;">
              <h4 class="pt-3 pb-1" style="text-align: center">{{$item->name}}</h4>
              <div class="border-top border-bottom">
                <table class="table table-borderless my-1">
                  <tbody>
                    <tr>
                      <th width="10px">Email</th>
                      <td>{{$item->email}}</td>
                    </tr>
                    <tr>
                      <th width="10px">Phone:</th>
                      <td>{{$item->phone}}</td>
                    </tr>
                    <tr>
                      <th width="10px">Address</th>
                      <td>{{$item->address}}</td>
                    </tr>
                    <tr>
                      <th width="10px">Description</th>
                      <td>{{$item->description}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
                <form action="{{ route('map.destroy', $item->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" style="text-align:center">Delete</button>
                </form>
            </div>
          `
        ).addTo(map);
      @endforeach


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

      @if (!session()->has('record_created'))
        <script>
            Toast.fire({
                icon: 'success',
                title: 'New record has been added successfully!'
            });
        </script>
    @endif
    </script>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <title>Gis #2</title>
</head>
<body>
    @include('sweetalert::alert')
    <h3 class="title">Read Only Hospital Map With Leaflet</h3>
    <div class="map" id="map"></div>

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
            </div>
          `
        ).addTo(map);
      @endforeach
    </script>
</body>
</html>

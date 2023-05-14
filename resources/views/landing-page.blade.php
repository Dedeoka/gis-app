<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
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
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <title>Gis #2</title>
</head>
<body>
    @include('sweetalert::alert')
    {{--   --}}
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

      var cluster = L.markerClusterGroup();

      @foreach ($data as $item)
        cluster.addLayer(L.marker([{{ $item->latitude }},{{ $item->longitude }}], {icon: markerIcon,})
            .bindPopup(
          `
            <div class="" style="width: 18rem;">
              <h4 class="pt-3 pb-1" style="text-align: center">{{$item->name}}</h4>
              <div class="margin=0 auto;">
                <img src="{{ asset('foto/rumahsakit/'.$item->thumbnail_name) }}" alt="" class="d-block w-100">
                </div>
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
        )
        )
        //   .on('click', function(e) {
        //     var detail = document.getElementById('detail');
        //     $.ajax({
        //     url: "{{ url('ajaxuser') }}" + '/' + $item->id + '/edit',
        //     type: 'GET',
        //     success: function(response) {
        //         hint.style.display = 'block';
        //         console.log(response.result);
        //     }
        //     });
        // });
      @endforeach
      map.addLayer(cluster);
    </script>
</body>
</html>

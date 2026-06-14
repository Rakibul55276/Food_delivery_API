@extends('restaurant.layouts.app')

@section('content')

<h2>Restaurant Profile</h2>

<form action="{{ route('restaurant.profile.update') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Restaurant Name</label>
        <input type="text"
               name="name"
               value="{{ old('name', $restaurant->name) }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description"
                  class="form-control">{{ old('description', $restaurant->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text"
               name="phone"
               value="{{ old('phone', $restaurant->phone) }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Address</label>
        <textarea name="address"
                  class="form-control"
                  rows="3">{{ old('address', $restaurant->address) }}</textarea>
    </div>

    <div class="mb-3">
        <button type="button"
                class="btn btn-primary"
                onclick="getCurrentLocation()">
            Get Current Location
        </button>

        <a href="#"
           id="mapLink"
           target="_blank"
           class="btn btn-success">
            Open in Google Maps
        </a>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Latitude</label>
            <input type="text"
                   id="latitude"
                   name="latitude"
                   value="{{ old('latitude', $restaurant->latitude) }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Longitude</label>
            <input type="text"
                   id="longitude"
                   name="longitude"
                   value="{{ old('longitude', $restaurant->longitude) }}"
                   class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label>Logo</label><br>

       @if($restaurant->logo)

    {{-- Common Image Helper --}}
    <img
        src="{{ imageUrl($restaurant->logo) }}"
        alt="Restaurant Logo"
        width="100"
        class="mb-2 rounded border"
    >

@endif

        <input type="file"
               name="logo"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Cover Image</label><br>

        @if($restaurant->cover_image)

    {{-- Common Image Helper --}}
    <img
        src="{{ imageUrl($restaurant->cover_image) }}"
        alt="Cover Image"
        width="200"
        class="mb-2 rounded border"
    >

@endif

        <input type="file"
               name="cover_image"
               class="form-control">
    </div>

    <button class="btn btn-success">
        Update Profile
    </button>

</form>

<script>
function updateMapLink() {
    let lat = document.getElementById('latitude').value;
    let lng = document.getElementById('longitude').value;

    if (lat && lng) {
        document.getElementById('mapLink').href =
            'https://www.google.com/maps?q=' + lat + ',' + lng;
    } else {
        document.getElementById('mapLink').href = '#';
    }
}

function getCurrentLocation()
{
    if (!navigator.geolocation) {
        alert('Geolocation is not supported.');
        return;
    }

    navigator.geolocation.getCurrentPosition(

        function(position) {

            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            updateMapLink();

            fetch(
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`
            )
            .then(response => response.json())
            .then(data => {

                if(data.display_name){

                    document.querySelector(
                        'textarea[name="address"]'
                    ).value = data.display_name;

                }

            });

            alert('Location captured successfully.');
        },

        function(error) {
            alert('Please allow location access.');
        }
    );
}

document.getElementById('latitude').addEventListener('input', updateMapLink);
document.getElementById('longitude').addEventListener('input', updateMapLink);

updateMapLink();
</script>

@endsection
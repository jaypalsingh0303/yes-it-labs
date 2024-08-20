<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container">
        <a class="navbar-brand" href="{{route("home")}}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            <div class="d-flex" role="search">
                    <a href="{{route("location_distance", ["origin_lat" => "27.1767", "origin_long" => "78.0081", "destination_lat" => "28.5355", "destination_long" => "77.3910", "unit" => "km"])}}" class="btn btn-outline-primary me-2">Location distance</a>
                    <a href="{{route("audio_duration")}}" class="btn btn-outline-danger me-2">Audio duration</a>
                    <a href="{{route("create")}}" class="btn btn-outline-primary me-2">Add user</a>
            </div>
        </div>
    </div>
</nav>

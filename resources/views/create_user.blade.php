@extends('layouts.dashboard')

@section('title')
    create user
@endsection

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('store_user') }}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                           <input type="hidden" name="type" value="{{ $type }}">
                                            <div class="form-body">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> user name
                                                            </label>
                                                            <input type="text" id="name" class="form-control"
                                                                placeholder="  " value="{{ old('name') }}" name="name">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> email
                                                            </label>
                                                            <input type="email" id="email" class="form-control"
                                                                placeholder="  " value="{{ old('email') }}" name="email">
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h6 for="bio"> bio</h6>
                                                              <textarea name="bio" id="bio" cols="60" rows="5"></textarea>
                                                            @error('bio')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>




                                                    </div>

                                                </div>
                                                 <!-----------------------------------------type 2------------------------------>

                                                 @isset($type)
                                                 @if ($type==2)
                                                 <div class="form-body">
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label for="projectinput1"> title
                                                               </label>
                                                               <input type="text" id="title" class="form-control"
                                                                   placeholder="  " value="{{ old('title') }}" name="title">
                                                               @error('title')
                                                                   <span class="text-danger">{{ $message }}</span>
                                                               @enderror
                                                           </div>




                                                   <h4 class="form-section"><i class="ft-home"></i>  </h4>
                                                   <div class="form-group">
                                                       <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                           <div class="dz-message">You can upload  one picture here</div>
                                                       </div>
                                                       <br><br>
                                                   </div>


                                               </div>

                                                    @endisset
                                                    @endif



                                                  <!-----------------------------------------type 3------------------------------>
                                             @isset($type)
                                             @if ($type==3)
                                            <input hidden name="lat" id="lat">
                                            <input hidden name="lng" id="lng">
                                             <div id="googleMap" style="witdth:80%;height:200px;">
                                            </div><br>

                                             <div class="row">




                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> date birth
                                                        </label>

                                                        <input type="date" id="date"
                                                        class="form-control"
                                                        placeholder=""
                                                        value="{{old('date_birth')}}"
                                                        name="date_birth">

                                                 @error('date_birth')
                                                 <span class="text-danger"> {{$message}}</span>
                                                 @enderror
                                             </div>

                                             @endif

                                             @endisset
                                                     </div>


                                                    </div>
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                    <i class="ft-x"></i> close
                                                </button>

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> save
                                                </button>


                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9UBKQHciVMSJZEoM640mtwKkTXavjrD4"></script>
<script>
    var myCenter = new google.maps.LatLng(28.214461283939166,83.95801313236007);
    var mapOptions = {center: myCenter, zoom: 14,mapTypeId:google.maps.MapTypeId.HYBRID};
    var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
    function addmarker(latilongi) {
        var marker = new google.maps.Marker({
            position: latilongi,
            title: 'new marker',
            draggable: true,
            map: map
        });
        map.setCenter(marker.getPosition())
            google.maps.event.addListener(marker, 'dragend', function() {
            map.setCenter(marker.getPosition());
            $("#lat").val(marker.getPosition().lat());
            $("#lng").val(marker.getPosition().lat());
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude

                var pos = {
                    lat: lat,
                    lng: lng
                };
                marker.setPosition(pos)
                $("#lat").val(lat);
                $("#lng").val(lng);
                map.setCenter(pos);
            }, function () {

            });
        }
    }
    addmarker(myCenter);
    </script>


    <script>

        var uploadedDocumentMap = {}
    Dropzone.options.dpzMultipleFiles = {
        paramName: "dzfile", // The name that will be used to transfer the file
        //autoProcessQueue: false,
        maxFilesize: 5, // MB
        maxFiles: 1, // Set the maximum number of files to 1
    clickable: true,
    addRemoveLinks: true,
    acceptedFiles: 'image/jpeg,image/bmp,image/png,application/pdf,image/*',
    dictFallbackMessage: 'Your browser does not support multiple images and drag and drop',
    dictInvalidFileType: 'You cannot upload this type of file',
    dictCancelUpload: 'cancel upload',
    dictCancelUploadConfirmation:'Are you sure to cancel uploading files',
    dictRemoveFile: 'delete picture',
    dictMaxFilesExceeded: 'You cannot upload more than this',
    headers: {
        'X-CSRF-TOKEN':
            "{{ csrf_token() }}"
    }

    ,
    url: "{{ route('save_image_in_folder') }}", // Set the url
    success:
        function (file, response) {
            $('form').append('<input type="hidden" name="document" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        }
    ,
    removedfile: function (file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="document"][value="' + name + '"]').remove()
    }
    ,
    // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
    init: function () {

            @if(isset($event) && $event->document)
        var files =
        {!! json_encode($event->document) !!}
            for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="document" value="' + file.file_name + '">')
        }
        @endif
    }
}


</script>

@endsection

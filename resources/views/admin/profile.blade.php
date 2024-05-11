@extends('admin.layouts.app')
@section('title')
     Profile
@endsection
@section('css')
<style>
#img-preview {
    max-width: 100%;
    max-height: 200px;
    margin-top: 10px;
  }
  </style>
@endsection
@section('content')
    <div class="content-wrapper pt-3">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user mr-2"></i> About Me</h3>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{$user->profile_photo_url}}"
                                        alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$user->name}}</h3>

                                <p class="text-muted text-center">{{$user->getRoleNames()->first()}}</p>

                                <a class="btn btn-outline-lightblue btn-block" href="mailto:{{$user->email}}">
                                    <i class="fas fa-envelope mr-2"></i>
                                    {{$user->email}}
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <ul class="nav nav-tabs d-flex flex-row align-items-start card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{route("profile")}}"><i
                                                class="fas fa-cog mr-2"></i>Profile Settings</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route("profile.update")}}" accept-charset="UTF-8">
                                    @method("PATCH")
                                    @csrf

                                            <!-- Name Field -->
                                            <div class="form-group ">
                                                <label for="name" class="">Name</label>

                                                    <input class="form-control" placeholder="Insert Name" name="name" type="text"
                                                        value="{{$user->name}}" id="name">


                                            </div>

                                            <!-- Email Field -->
                                            <div class="form-group ">
                                                <label for="email" class="">Email</label>

                                                    <input class="form-control" placeholder="Insert Email" name="email" type="text"
                                                    value="{{$user->email}}" id="email">


                                            </div>
                                            <!--sec Email Field -->



                                            <!-- Password Field -->
                                            <div class="form-group ">
                                                <label for="password" class="">Password</label>

                                                    <input class="form-control" placeholder="Insert Password" name="password"
                                                        type="password" value="" id="password" autocomplete="off">


                                            </div>


                                            <div class="form-group">
                                                <label for="avatar">Profile Picture</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="avatar">
                                                        <label class="custom-file-label" for="avatar">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="preview mb-3" id="preview">

                                            </div>



                                        <!-- Submit Field -->
                                        <div
                                            class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
                                            <button type="submit" class="btn bg-lightblue mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
                                                <i class="fas fa-save"></i> Save User</button>
                                            <a href="{{url()->previous()}}" class="btn btn-default"><i class="fas fa-undo"></i>
                                                Cancel</a>
                                        </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
<script>
     $(document).ready(function() {
        $('#avatar').change(function() {
            var file = this.files[0];
            var preview = $('#preview');

            // Check if the file is an image
            if(file.type && !file.type.startsWith('image')) {
                Swal.fire("Error", "Please select an image file.", "error");
                return;
            }

            // Check file size
            if(file.size > 2 * 1024 * 1024) {
                Swal.fire("Error", "File size exceeds the maximum allowed size of 2MB.", "error");
                return;
            }

            // Generate a unique identifier
            var uniqueIdentifier = Date.now().toString(36) + Math.random().toString(36).substr(2, 9);

            // Rename the file with a unique name
            var fileNameParts = file.name.split('.');
            var fileExtension = fileNameParts.pop();
            var newFileName =  uniqueIdentifier + '.' + fileExtension;

            // Update the label text with the new file name and size
            $(this).next('.custom-file-label').html(newFileName + ' (' + formatBytes(file.size) + ')');

            var reader = new FileReader();

            reader.onload = function(event) {
                var img = $('<img>').attr('src', event.target.result).css({'max-width': '200px','max-height':'200px'});
                preview.empty().append(img);
            };

            reader.readAsDataURL(file);
        });
    });

    // Function to format bytes as KB, MB, etc.
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }
</script>
@endsection

@section('pageTitle', 'Profile')


@if(Auth::user())

    @include("../../includes.head")
    <link rel="stylesheet" href="{{URL::asset('notiflix/notiflix-2.3.2.min.css')}}" />

    @include("../../includes.header")
    @include("../../includes.nav")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{@$user->image}}" alt="User profile picture">
                        <h3 class="profile-username text-center">{{@$user->name}}</h3>
                        <p class="text-muted text-center">{{@$user->designaion->name}}</p>

                        <ul class="list-group list-group-unbordered">

                        </ul>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personal Info</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-inbox margin-r-5"></i> Email</strong>
                        <p class="text-muted">
                            {{@$user->email}}
                        </p>

                        <hr>

                        <strong><i class="fa fa-id-card margin-r-5"></i> CNIC</strong>
                        <p class="text-muted">
                            {{@$user->cnic}}
                        </p>

                        <hr>
                        <strong><i class="fa fa-phone margin-r-5"></i> Contact </strong>
                        <p class="text-muted">
                            {{@$user->contact_no}}
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                        <p class="text-muted">{{@$user->address}}</p>

                        <hr>

                        <strong><i class="fa fa-star margin-r-5"></i> Status</strong>
                        <p>
                            @if($user->status == 'active')<span class="label label-success">Active</span>@endif
                            @if($user->status == 'inactive') <span class="label label-danger">InActive</span>@endif
                        </p>

                        <hr>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
{{--                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>--}}
                        <li class="active"><a href="#info" data-toggle="tab">Personal Info</a></li>
                        <li><a href="#settings" data-toggle="tab">Change Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class=" active time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs">Read more</a>
                                            <a class="btn btn-danger btn-xs">Delete</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div><!-- /.tab-pane -->

                        <div class="active tab-pane" id="info">
                            <form class="form-horizontal" id="personal_info">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Name" value="{{@$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email" value="{{@$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCNIC" class="col-sm-2 control-label">CNIC</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="inputCNIC" id="inputCNIC" placeholder="Name" value="{{@$user->cnic}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputContact" class="col-sm-2 control-label">Contact No</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="inputContact" id="inputContact" placeholder="Contact" value="{{@$user->contact_no}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Address">{{@$user->address}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file" class="col-sm-2 control-label">Profile Picture</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="file" id="file" placeholder="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-info" id="update-info">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="old_password" class="col-sm-2 control-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="old_password" placeholder="Old Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password" class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="new_password" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="conf_password" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="conf_password" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.tab-pane -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

    <script src="{{URL::asset('notiflix/notiflix-2.3.2.min.js')}}"></script>
    @include("../../includes.footer")

    <!-- /.modal -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#personal_info').submit(function (e){
            e.preventDefault();
            let inputName = $('#inputName').val();
            let inputEmail = $('#inputEmail').val();

            !inputName?addClass('inputName'):removeClass('inputName');
            !inputEmail?addClass('inputEmail'):removeClass('inputEmail');

            if(!inputName || !inputEmail)
            {
                Notiflix.Notify.Warning("Fill all the required Fields.");
                return;
            }
            let formData = new FormData(this);

            $.ajax({
                url:'{{url("profile/update")}}',
                type:'POST',
                data: formData,
                cache:false,
                contentType:false,
                processData:false,
                beforeSend: function(){
                    Notiflix.Loading.Pulse('Processing...');
                },
                // You can add a message if you wish so, in String formatNotiflix.Loading.Pulse('Processing...');
                success: function (response) {
                    Notiflix.Loading.Remove();
                    if(response.success){
                        Notiflix.Notify.Success(response.success);
                    }
                    console.log('response', response);
                    location.reload();
                },
                error:function(response, exception){
                    Notiflix.Loading.Remove();
                    $.each(response.responseJSON, function (index, val) {
                        Notiflix.Notify.Failure(val);
                    })
                }
            });
        });
    </script>


@else
    {{"Login to Access this page"}}
    <script type="text/javascript">window.location.replace('login');</script>

@endif



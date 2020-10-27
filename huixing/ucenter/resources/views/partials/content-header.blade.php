<section class="content-header" style="height: 56px;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @if(isset($title))
                <h4>{{$title}}</h4>
                @endif
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ ucenter_url('/') }}">Home</a></li>
                    @for($i = 2; $i <= count(Request::segments()); $i++)
                    <li class="breadcrumb-item active">{{ucfirst(Request::segment($i))}}</li>
                    @endfor
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@include('ucenter::partials.toastr')
@include('ucenter::partials.alerts')
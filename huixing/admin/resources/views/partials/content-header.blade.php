<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Invoice</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">Home</a></li>
                    @for($i = 2; $i <= count(Request::segments()); $i++)
                    <li class="breadcrumb-item active">{{ucfirst(Request::segment($i))}}</li>
                    @endfor
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
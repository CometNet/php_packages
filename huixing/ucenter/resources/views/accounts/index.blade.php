@extends(Request::instance()->layout)

@section('content')
    @include('ucenter::partials.content-header',['title' => '基本信息'])
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="image">
                                    <img src="http://dev.cn:8888/vendor/ucenter/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row form-group">
                                    <div class="col-sm-4 col-md-2">登录名：</div>
                                    <div class="col-sm-4 col-md-6">{{\Huixing\UCenter\Facades\UCenter::user()->username}}</div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4 col-md-2">登录密码：</div>
                                    <div class="col-sm-4 col-md-6">安全性高的密码可以使帐号更安全。建议您定期更换密码，设置一个包含字母，符号或数字中至少两项且长度超过6位的密码</div>
                                    <div class="col-sm-4 col-md-2"><a href="#" onclick="AccountUpdate('登录密码','password')">修改</a></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4 col-md-2">用户姓名：</div>
                                    <div class="col-sm-4 col-md-6">{{\Huixing\UCenter\Facades\UCenter::user()->name}}</div>
                                    <div class="col-sm-4 col-md-2"><a href="#" onclick="AccountUpdate('用户姓名','name')">修改</a></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4 col-md-2">手机号码：</div>
                                    <div class="col-sm-4 col-md-6">{{\Huixing\UCenter\Facades\UCenter::user()->phone}}</div>
                                    <div class="col-sm-4 col-md-2"><a href="#" onclick="AccountUpdate('手机号码','phone')">修改</a></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4 col-md-2">绑定邮箱：</div>
                                    <div class="col-sm-4 col-md-6">{{\Huixing\UCenter\Facades\UCenter::user()->email}}</div>
                                    <div class="col-sm-4 col-md-2"><a href="#" onclick="AccountUpdate('绑定邮箱','email')">修改</a></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4 col-md-2">剩余金额：</div>
                                    <div class="col-sm-4 col-md-6">{{\Huixing\UCenter\Facades\UCenter::user()->money}}</div>
                                    <div class="col-sm-4 col-md-2"><a href="{{ucenter_base_path('cost/create')}}">充值</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function AccountUpdate(title, field){
            swal({
                text: '修改'+title,
                content: "input",
                button: {
                    text: "修改",
                    closeModal: true,
                },
            })
                .then(value => {
                    if (!value) throw null;
                    return new Promise(function(resolve) {
                        $.ajax({
                            url:"{{ucenter_url('account/update')}}",
                            dataType:"json",
                            async:false,
                            type:'put',
                            data:{
                                _token: LA.token,
                                field: field,
                                value: value
                            },
                            success:function(data){
                                resolve(data);
                            }
                        });
                    });
                })
                .then(results => {
                    if (results.code != 0) {
                        return swal("修改错误!");
                    }
                    $.pjax.reload('#pjax-container');
                })
                .catch(err => {
                    if (err) {
                        swal("错误!", "请求错误!", "error");
                    } else {
                        swal.stopLoading();
                        swal.close();
                    }
                });
        }
    </script>
@endsection
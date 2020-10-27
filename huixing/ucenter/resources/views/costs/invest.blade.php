@extends(Request::instance()->layout)

@section('content')
    @include('ucenter::partials.content-header',['title' => '充值'])
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <form action="{{ ucenter_url('cost') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="alipay callout callout-danger" style="font-size: 10px;">
                            <span>温馨提示：</span>
                            <div>1、受银行处理时间影响，采用线下汇款方式到账会有延误。</div>
                            <div>2、线下汇款直接向聚合的专属账户汇款，系统会将款项直接匹配到您的数据账户（具体到账时间以银行的实际到账时间为准）。</div>
                            <div>3、专属账户暂不支持支付宝，财付通等平台转账汇款。</div>
                            <div class="text-danger">4、付款方的银行开户名必须与聚合实名认证信息同名，同时本名称将是您后期开增值税专用发票的名称。企业用户必须公对公转账，否则不给予入账。</div>
                        </div>
                        <div class="bankcard callout callout-danger" style="font-size: 10px;">
                            <span>温馨提示：</span>
                            <div>1、转账备注中请写明聚合数据账号、购买的数据名称和联系电话。</div>
                            <div>2、转账成功后输入支付宝订单号确认，您也可以在充值后和我们的客服联系。</div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 col-md-2">可用余额：</div>
                            <div class="col-sm-2 col-md-1">￥0.00</div>
                            <div class="col-sm-8 col-md-4 text-danger">充值金额只有消费后才可开具发票（充值类订单不支持）</div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 col-md-2">
                                <span class="text-center">充值方式:</span>
                            </div>
                            <div class="col-sm-2 col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="pay_type" checked>
                                    <label class="form-check-label">支付宝</label>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" value="2" type="radio" name="pay_type">
                                    <label class="form-check-label">银行转账</label>
                                </div>
                            </div>
                        </div>
                        <div class="alipay">
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">支付宝账号:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">boytanhao@sohu.com</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">支付宝账号:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <input type="text" class="form-control form-control-sm" placeholder="请输入支付宝订单号">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">* 支付宝订单号:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <input type="text" class="form-control form-control-sm" placeholder="请输入支付宝订单号">
                                </div>
                            </div>
                        </div>
                        <div class="bankcard">
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">开户名称:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">卢园</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">开户银行:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" value="3" type="radio" name="bank">
                                        <label class="form-check-label">中国农业银行</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">开户账号:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">622323353543534543</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">转账卡号:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <input type="text" class="form-control form-control-sm" placeholder="转账卡号">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 col-md-2">
                                    <span class="text-center">流水单号:</span>
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <input type="text" class="form-control form-control-sm" placeholder="转账流水单号">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function init(){
            $('.alipay').show();
            $('.bankcard').hide();
        }

        $('input:radio[name="pay_type"]').click(function(){
            var checkValue = $('input:radio[name="pay_type"]:checked').val();
            switch (checkValue) {
                case "1":
                    $('.alipay').show();
                    $('.bankcard').hide();
                    break;
                case "2":
                    $('.alipay').hide();
                    $('.bankcard').show();
                    break;

            }
        });
    </script>
@endsection

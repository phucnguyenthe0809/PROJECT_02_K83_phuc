<div id="colorlib-subscribe">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6 text-center">
                    <h2><i class="icon-paperplane"></i>Đăng ký nhận bản tin</h2>
                </div>
                <div class="col-md-6">
                    <form action="/send" class="form-inline qbstp-header-subscribe" method="POST"> @csrf
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Nhập email của bạn">
                                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

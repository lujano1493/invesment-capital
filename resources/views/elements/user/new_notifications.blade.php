  <div class="col-lg-3 col-md-6">
    <div class="panel {{ $colorClass }}">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class=" {{ $icon }} fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge count-new"> {{  $countNew }}</div>
                    <div>{{ $dsc }}</div>
                </div>
            </div>
        </div>
        <a href=" {{ $route }}">
            <div class="panel-footer">
                <span class="pull-left">  Ver Detalles</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>


@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div id="alert" class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 1500)" x-show="show">
            <div class="alert alert-success"> {{ $data }}</div>
        </div>
    @endif
@endif

@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('logbook::logbooks.title.edit logbook') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.logbook.logbook.index') }}">{{ trans('logbook::logbooks.title.logbooks') }}</a></li>
        <li class="active">{{ trans('logbook::logbooks.title.edit logbook') }}</li>
    </ol>
@stop


@section('content')

    {!! Form::open(['route' => ['admin.logbook.entry.update', $entry->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('logbook::admin.logentries.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach
            </div> {{-- end nav-tabs-custom --}}
                <div class="box-footer">
                    <button type="submit"  class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.logbook.logbook.index')}}">
                        <i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}
                    </a>
                </div>
        </div>
    </div>

    {!! Form::close() !!}


@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop


@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.logbook.logbook.index') ?>" }
                ]
            });
        });

    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
        <?php $locale = locale(); ?>

    </script>

@endpush



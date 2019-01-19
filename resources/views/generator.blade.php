@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                {!! Form::open(['route' => 'process']) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('type', 'Button Type:')  !!}
                            {!! Form::select('type', $types, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('width', 'Button Width:')  !!}
                            {!! Form::text('width', old('width', '100'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('height', 'Button Height:')  !!}
                            {!! Form::text('height', old('height', '100'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('padding', 'Padding:')  !!}
                            <div id="padding" class="dragdealer">
                                <div class="handle padding-bar">
                                    <span class="value"></span>
                                </div>
                            </div>
                            {{ Form::hidden('padding', old('padding', '2'), ['id' => 'padding_hidden']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('base_color', 'Base color:')  !!}
                            {!! Form::text('base_color', old('base_color', '#C718AA'), ['class' => 'form-control', 'id' => 'mycp_base']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('icon_color', 'Icon color:')  !!}
                            {!! Form::text('icon_color', old('icon_color', '#ffffff'), ['class' => 'form-control', 'id' => 'mycp_icon']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('coef', 'Icon size:')  !!}
                            <div id="coef" class="dragdealer">
                                <div class="handle coef-bar">
                                    <span class="value"></span>%
                                </div>
                            </div>
                            {{ Form::hidden('coef', old('coef', '40'), ['id' => 'coef_hidden']) }}
                        </div>
                    </div>
                </div>

                {!! Form::submit('Generate', ['class' => 'form-control btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
            <div class="col-md-3">
                <img src="{{ $result }}"/>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#mycp_base').colorpicker({
                useAlpha: false,
                format: 'hex'
            }).on('colorpickerChange colorpickerCreate', function (e) {
                $('#mycp_base').css('background-color', e.color.toRgbString());
                if (e.color.isDark()) {
                    $('#mycp_base').css('color', 'white');
                } else {
                    $('#mycp_base').css('color', 'black');
                }
            });
            $('#mycp_icon').colorpicker({
                useAlpha: false,
                format: 'hex'
            }).on('colorpickerChange colorpickerCreate', function (e) {
                $('#mycp_icon').css('background-color', e.color.toRgbString());
                if (e.color.isDark()) {
                    $('#mycp_icon').css('color', 'white');
                } else {
                    $('#mycp_icon').css('color', 'black');
                }
            });
            new Dragdealer('padding', {
                x: '{{ old('padding', 2) / 10 }}',
                steps: 100,
                snap: true,
                animationCallback: function (x, y) {
                    $('#padding .value').text(Math.round(x / 10 * 100));
                    $('#padding_hidden').val(Math.round(x / 10 * 100));
                }
            });
            new Dragdealer('coef', {
                x: '{{ old('coef', 40) / 100 }}',
                animationCallback: function (x, y) {
                    $('#coef .value').text(Math.round(x * 100));
                    $('#coef_hidden').val(Math.round(x * 100));
                }
            });
        });
    </script>
@endsection

@section('styles')
@endsection
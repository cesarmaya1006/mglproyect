@extends('extranet.layout.app')
@section('cssPagina')
<link rel="stylesheet" href="{{ asset('css/extranet/login.css') }}">
@endsection
@section('cuerpoPagina')
<div class="row d-flex justify-content-center mt-5">
    <div class="col-12 col-md-8">
        <div class="login-wrap">
            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Ingresar</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                <form action="{{ route('login') }}" method="post" class="login-form">
                     @method('post')
                    @csrf
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="email" class="label">Email</label>
                            <input id="email" type="email" name="email" class="input">
                        </div>
                        <div class="group">
                            <label for="password" class="label">Contraseña</label>
                            <input id="password" name="password" type="password" class="input" data-type="password">
                        </div>
                        <<div class="group">
                            <input type="submit" class="button" value="Ingresar">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#">Olvido su Contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</section>

</div>

</div>
</div>
@endsection
@section('scriptPagina')
<script src="{{ asset('js/extranet/login.js') }}"></script>
@endsection

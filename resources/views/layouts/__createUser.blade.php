<!---campo de nombre---->
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('users.detail.name')</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',  $user->name) }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>

<!---Campo de apellido---->
<div class="form-group row">
    <label for="last_name" class="col-md-4 col-form-label text-md-right">@lang('users.detail.lastName')</label>
        <div class="col-md-6">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $user ->last_name) }}" required autocomplete="name" autofocus>

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>
<!---campo de email---->

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('users.detail.email')</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>
<!---campo de telefono---->
<div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('users.detail.mobile')</label>
        <div class="col-md-6">
            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="name" autofocus>

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>
<!---campos de contraseña--->
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">@lang('users.detail.password')</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" @if(!$user->exists()) required @endif autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('users.detail.confirmPassword')</label>
        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(!$user->exists()) required @endif autocomplete="new-password">
        </div>
</div>

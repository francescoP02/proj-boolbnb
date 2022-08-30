@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" minlength="3" name="name" value="{{ old('name') }}" autocomplete>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" minlength="3" name="surname" value="{{ old('surname') }}" autocomplete>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Birth_date') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address(*)') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" onkeyup="checkEmail()" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                <p id="valid-email"></p>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password(*)') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" minlenght="8" onkeyup="checkPassword()" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password(*)') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" onkeyup="checkPassword()" name="password_confirmation" required autocomplete="new-password">
                                <p id="password-matched"></p>
                                <p id="password-length"></p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button disabled type="submit" class="btn btn-primary" id="submitButton">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>   
                </div>
                <p class="text-center">* Questi campi sono obbligatori</p>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    const button = document.getElementById('submitButton');
    
    function checkPassword() {
        let passwordFlag = false;
        let passwordLenght = false;
        const password = "";

        console.log("debug");
        const confirmPassword = document.getElementById('password-confirm').value;

        if (password.length < 8) {
            document.getElementById('password-length').innerHTML = "Password must be at least 8 characters";
            passwordLenght = false;
        } else if (password.length >= 8) {
            document.getElementById('password-length').innerHTML = "";
            passwordLenght = true;
        }

        if (password === confirmPassword) {
            document.getElementById('password-matched').innerHTML = "Password is correct";
            passwordFlag = true;
            
        } else if (password !== confirmPassword) {
            document.getElementById('password-matched').innerHTML = "Password is incorrect";
            passwordFlag = false;
            
        }

        if (passwordFlag && passwordLenght) {
            return true;
        } else  {
            return false;
        }

    }

    console.log(checkPassword());

    function checkEmail() {
        let emailFlag = false;

        const email = document.getElementById('email').value;

        if (email.includes("@") && email.includes(".")) {
            document.getElementById('valid-email').innerHTML = "";
            return true;
            
        } else {
            document.getElementById('valid-email').innerHTML = "Email is invalid";
            return false;
        }
    }

    console.log(checkEmail());

    
        
    if (checkEmail()&&checkPassword() === false) {

        button.removeAttribute('disabled');

    } else {

        button.setAttribute('disabled', '');
            
    }
    
</script>

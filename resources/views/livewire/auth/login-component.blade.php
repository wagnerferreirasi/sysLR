@section('title', 'Login')
@section('styles')
<style>
#password {
    width: 150px;
    padding-right: 20px;
}

.togglePassword {
    cursor: pointer;
    left: 160px;
    position: absolute;
    width: 20px;
}
</style>
@endsection
<div>
    <section class="login">
        <div class="container my-5">
            <div class="row">
                <div class="col-sm-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4 text-center mb-3">
                    <img src="{{ asset('Assets/img/logoalpha.png') }}" class="img-fluid" width="150"
                        alt="Logo LRTUR TRANSLOG">
                </div>
                <div class="col-sm-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                    <p class="text-center">Para acessar o sistema realize login a baixo.</p>
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <hr class="mb-5">
                    <form wire:submit.prevent="validateLogin">
                        @csrf
                        <div class="mb-3">
                            <label for="login"><i class="bi bi-person-circle"></i> Login</label>
                            <input type="text" name="login" wire:model.defer="login" class="form-control" required>
                            @error('login')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label m-0"><i class="bi bi-key-fill"></i> Senha</label>
                            <div class="input-group mb-3">
                                <input type="password" name="password" wire:model.defer="password" id="password"
                                    class="form-control" required>
                                <span class="input-group-text">
                                    <i class="bi bi-eye" id="togglePassword" style="cursor: pointer"></i>
                                </span>
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="place"><i class="bi bi-shop"></i> Loja</label>
                            <select class="form-select" name="place" id="place" wire:model.defer="place" required>
                                <option value="" selected>Selecione sua Loja</option>
                                @foreach ($places as $place)
                                <option value="{{$place->id}}">{{$place->name}}</option>
                                @endforeach
                            </select>
                            @error('place')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-lg btn-warning" type="submit" wire:click="$emitTo('loading_login')">
                                    <i class="bi bi-door-open-fill"></i> Entrar
                                </button>
                            </div>
                        </div>
                        <!-- <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <a href="" class="btn btn-outline-dark">Esqueci a senha?</a>
                            </div>
                        </div>
                    </div> -->
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@section('scripts')
<script>
document.getElementById('togglePassword').addEventListener('mousedown', function() {
    document.getElementById('password').type = 'text';
});

document.getElementById('togglePassword').addEventListener('mouseup', function() {
    document.getElementById('password').type = 'password';
});

// Para que o password não fique exposto apos mover a imagem.
document.getElementById('togglePassword').addEventListener('mousemove', function() {
    document.getElementById('password').type = 'password';
});

document.addEventListener('loading_login', function() {
    Swal.fire({
        title: 'Aguarde...',
        text: 'Estamos validando seu login...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading()
        }
    });
});


</script>
@endsection

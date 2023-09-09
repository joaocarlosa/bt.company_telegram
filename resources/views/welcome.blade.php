<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Segurança 4.0</title>

    <style>
        .custom-h1 {
            font-size: 48px;
            color: white;
        }

        .custom-p {
            font-size: 24px;
            color: white;
            
        }

        .alignCenter {
            position: fixed;
            bottom: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            text-align: center;
        }

        .topLogin {
    position: fixed;
    top: 10px;
    right: 10px;
    z-index: 2;
    color: white;
    padding-top: 20px;   /* Espaçamento no topo */
    padding-right: 20px; /* Espaçamento à direita */
}


        .text-white-custom {
            color: white !important;
            /* O `!important` é para sobrescrever qualquer outro estilo */
        }

        .no-underline {
            text-decoration: none !important;
        }



        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .video-background video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            ;
            /* Agora usando contain em vez de cover */
        }

        .dark-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 0;
        }
    </style>
</head>

<body>

    <div class="video-background">
        <video autoplay muted loop>
            <source src="{{ asset('assets/login-bg.mp4') }}" type="video/mp4">
        </video>
    </div>

    @if (Route::has('login'))
    <label class="topLogin">
        @auth
        <a href="{{ url('/dashboard') }}" class="text-white-custom no-underline font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-white-custom no-underline font-semibold focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Entrar</a>

        @endauth
    </label>


    @endif

    <div class="alignCenter">
        <h1 class="text-white text-4xl custom-h1">Segurança 4.0</h1>
        <p class="text-white custom-p">Uma nova forma de salvar vidas e proteger patrimônios!</p>

    </div>
</body>

</html>
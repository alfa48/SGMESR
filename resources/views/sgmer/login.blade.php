<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/dist/spectre.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/dist/login.css') }}" rel="stylesheet" type="text/css">
    <title>Document</title>
    <style>
     *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body{
    background-color: #4a229e;
   
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container{
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button{
    background-color: #4a229e;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input{
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in{
    transform: translateX(100%);
}

.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}

.social-icons{
    margin: 20px 0;
}

.social-icons a{
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
}

.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle{
    background-color: #4a229e;
    height: 100%;
    background: linear-gradient(to right, #5c6bc0, #4a229e);
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle{
    transform: translateX(50%);
}

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left{
    transform: translateX(-200%);
}

.container.active .toggle-left{
    transform: translateX(0);
}

.toggle-right{
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right{
    transform: translateX(200%);
}
body{
    background-color:white;
}

.login{
    color:#4a229e;
}
.cadastro{
    color:#4a229e;
}

    </style>
</head>
<body>
   
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1 class="cadastro">Cadastre-se</h1><br>
                <input type="text" placeholder="Insira nome">
                <input type="email" placeholder="Insira o email">
                <input type="password" placeholder="Insira a senha">
                <button>Cadastrar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            
            <form method="post" action="{{ route('logar') }}">
                @csrf
                <h1 class="login">Login</h1><br>
                <input type="email" name="email" required placeholder="Insira o email">
                <input type="password" name="password" required placeholder="Insira a password">
                
                <button><a href="{{ route("logar") }}" style="color: white;" class="hidden" id="register">Logar</a></button>
                
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Seja bem-vindo ao SolarWatch!</h1><br></br>
                    <p>Conectando você ao poder do sol, de forma simples e acessível</p>
                    <button class="hidden" id="login">Login</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Seja bem-vindo ao SolarWatch!</h1><br></br>
                <p>Cadastre-se agora e desfrute da energia solar em sua casa, de forma acessível e eficaz"</p>
                <a href="{{ route("cadastro") }}" style="color: white;" class="hidden" id="register">Cadastrar-se</a>
        
            </div>
        </div>
    </div>


</body>
</html>
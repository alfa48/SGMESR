<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield("title")</title>

  <link rel="stylesheet" href={{ asset('css/dist/spectre.min.css') }}>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Incluindo Chart.js -->
</head>
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");
* {
  margin: 0;
  padding: 0;
  outline: none;
  border: none;
  text-decoration: none;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  background:white;
}

.container {
  display: flex;
}

nav {
  position: relative;
  top: 0;
  bottom: 0;
  height: 100vh;
  left: 0;
 background-color:  #4a229e;
  width: 300px;
  overflow: hidden;
  box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
}

.logo {
  text-align: center;
  display: flex;
  margin: 10px 0 0 10px;
}

.logo img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
}

.logo span {
  font-weight: bold;
  padding-left: 15px;
  font-size: 18px;
  text-transform: none;
}


.item_menu span {
  font-weight: bold;
  padding-left: 15px;
  font-size: 18px;
  text-transform: none;
}

a {
  position: relative;
  color: rgb(85, 83, 83);
  font-size: 14px;
  display: table;
  width: 280px;
  padding: 10px;
  text-decoration: none;
}

nav .fas {
  position: relative;
  width: 30px;
  height: 0px;
  font-size: 20px;
  text-align: center;
  color: #fff;
}

h4 {
  position: absolute;
  padding: 15px;
  font-size: 16px;
}
.nav-item {
  position: relative;
  color: rgb(238, 234, 243);
  width: 12px;
  height: 10px;
  font-size: 20px;

}

a:hover {
/* background:rgb(71, 3, 105); */
  color-interpolation-filters:auto;
  background-color: #311775;
  text-decoration: none;
  width: 100%;
  align-content: center

}

.logout {
  position: absolute;
  bottom: 0;
 
}

/* Main Section */
.main {
  position: relative;
  padding: 20px;
  width: 100%;
}

.main-top {
  display: flex;
  width: 100%;
  margin: 10px 30px;
  color: rgb(110, 109, 109);
  cursor: pointer;

}

.main-top i {
  position: absolute;
  right: 0;
  margin: 10px 30px;
  color: rgb(110, 109, 109);
  cursor: pointer;
}

.main-skills {
  display: flex;
  margin-top: 20px;
}

.main-skills .card {
  width: 25%;
  margin: 10px;
  background: #fff;
  text-align: center;
  border-radius: 20px;
  padding: 10px;
  box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
}

.main-skills .card h3 {
  margin: 10px;
  text-transform: capitalize;
}

.main-skills .card p {
  font-size: 12px;
}

.main-skills .card button {
  background: orangered;
  color: #fff;
  padding: 7px 15px;
  border-radius: 10px;
  margin-top: 15px;
  cursor: pointer;
}

.main-skills .card button:hover {
  background: rgba(223, 70, 15, 0.856);
}

.main-skills .card i {
  font-size: 22px;
  padding: 10px;
}

/* Courses */
.main-course {
  margin-top: 20px;
  text-transform: capitalize;
}

.course-box {
  width: 100%;
  height: 300px;
  padding: 10px 10px 30px 10px;
  margin-top: 10px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
}

.course-box ul {
  list-style: none;
  display: flex;
}

.course-box ul li {
  margin: 10px;
  background-color: rgb(228, 225, 230);
  cursor: pointer;
}

.course-box ul .active {
  color: #000;
  border-bottom: 1px solid #000;
}

.course-box .course {
  display: flex;
}

.box {
  width: 33%;
  padding: 10px;
  margin: 10px;
  border-radius: 10px;
  background: rgb(235, 233, 233);
  box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
}

.box p {
  font-size: 12px;
  margin-top: 5px;
}

.box button {
  background: #000;
  color: #fff;
  padding: 7px 10px;
  border-radius: 10px;
  margin-top: 3rem;
  cursor: pointer;
}

.box button:hover {
  background: rgb(154, 63, 199);
      color-interpolation-filters: auto;
}

.box i {
  font-size: 7rem;
  float: right;
  margin: -20px 20px 20px 0;
}

ul{
color:white;
}

 i{
  background-color:white;
 }
 h1{
  color:  #4a229e;
 }
 label{
  color:  #4a229e;
  
 }
 .progress-bar {
  width: 100%;
  height: 30px;
  background-color: #2cad71;
  border-radius: 10px;
  overflow: hidden;
  margin: 0 auto; 
}


.card {
  background-color: #f9f9f9;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

h3 {
  font-size: 16px;
  margin-bottom: 10px;
  color: #333;
}

.setting {
  margin-bottom: 10px;

}

label {
  font-size: 14px;
  color: #555;
  display: block;
  margin-bottom: 5px;
}

input[type="radio"],
input[type="checkbox"],
input[type="text"],
select {
  margin-right: 10px;
}

input[type="radio"],
input[type="checkbox"] {
  vertical-align: middle;
}


select {
  padding: 5px;
  border-radius: 5px;
}
  
/*
css da tela de alerta
  //////////////////////////
  */  
   
  /*
este css da tela de casa
  //////////////////////////
  */  
 
  .card {
  width: 200px;
  height: 200px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.progress-circle {
  position: relative;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: conic-gradient(#0e812b 0% 70%, #f2f2f2 70% 100%);
}

.progress-inner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background-color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
}

.progress-percentage {
  font-size: 20px;
  color: #0e812b;
}
.accordion-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
}

input[name="accordion-checkbox"]:checked + .accordion-header + .accordion-body {
    max-height: 500px; /* ou um valor suficiente para acomodar o conteúdo */
}
.accordion {
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
    }

    .accordion-header {
        background-color: #f3f3f3;
        color: #4a229e;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        border-radius: 5px;
        font-family: Arial, sans-serif;
    }

    .accordion-body {
        color: #fff;
        padding: 10px;
        border: px solid #ccc;
        border-radius: 8px;
        margin-top: 5px;
        line-height: 1.6;
        background-color: #532fa0;
        font-family: 'Times New Roman', sans-serif; 
         font-size: 18px; 
         margin-left: 20px; 
         margin-bottom: 10px;
    }

    .accordion-body p {
        margin: 0; /* Remove margem padrão dos parágrafos dentro do corpo */
        font-family: Arial, sans-serif;
    }
    img{
      width: 25px;
      height: 25px;
      font-weight: bold;
  font-size: 18px;
  text-transform: none;
    }
    

.
</style>
<body>
  <div class="container">
    <nav>
      <ul>
          <a href="{{ route("dashboard") }}" class="logo">
            <img src="{{ asset("imagem/anjo.jpg")  }}" alt="">
            <span class="nav-item" style="font-family: 'Times New Roman', Times, serif; ">SolarSwich</span>
          </a>
       
        <a href="{{ route("casa") }}" class="item_menu">
          <img src="{{ asset("imagem/icons8-casa-64.png")  }}" alt="">
          <span class="nav-item" style="font-family: 'Times New Roman', Times, serif;margin-right: 5px;">Casa</span>
        </a>
        <a href="{{ route('alerta') }}" class="item_menu notification-icon">
          <img src="{{ asset('imagem/icons8-sirene-50.png') }}" alt="">
          <span class="nav-item" style="font-family: 'Times New Roman', Times, serif;">Alerta</span><br>
      </a>
        <a href="{{ route("ajuda") }}" class="item_menu">
          <img src="{{ asset("imagem/icons8-ajuda-50.png")  }}" alt=""> 
          <span class="nav-item" style="font-family: 'Times New Roman', Times, serif;"> Ajuda</span>
        </a>
        <a href="{{ route("config") }}" class="item_menu">
          <img src="{{ asset("imagem/icons8-configurações-50.png")  }}" alt="">
          <span class="nav-item" style="font-family: 'Times New Roman', Times, serif;">Configurações</span>
        </a>
      
      </a>
      <a href="{{ route("login") }}" class="logout" class="item_menu">
        <img src="{{ asset("imagem/icons8-logout-arredondado-50.png")  }}" alt="">
        <span class="nav-item" style="font-family: 'Times New Roman', Times, serif;"> Log out</span>
      </a>

      </ul>
    </nav>
    <section class="main">
      <div class="main-top">
        <h1 style="font-family: 'Times New Roman', Times, serif;">
          
          @if(isset($casas))
          
               Control
           
          @else 
                
              @yield("tema")
          
          @endif
         

        </h1>
      </div>
      
      @if(isset($perguntas))
           
      @else

      <!-- CARDS -->

      <div class="main-skills" >
        <div class="card" style= "color:#4a229e;">
          <h3 style=" color:#4a229e;">Enrgia produzida</h3>
          @if(isset($tensao1))
            <div id="data-container-tensao1">Carregando...</div><span>%</span>
            <img src="{{ asset("imagem/icons8-painel-solar-32.png")  }}" alt="">
          @else
          <img src="{{ asset("imagem/icons8-painel-solar-32.png")  }}" alt="">
              <span > OFF</span>
          @endif
          <p > WATSS</p>
        </div>
        <div class="card" style="position: relative; text-align: center; border: 1px solid #ee2525; border-radius: 10px; padding: 20px;"">
          <h3 style="color: ee2525;">Energia consumida</h3>
          @if(isset($casa))
      
          <span> {{ $casa->energiaConsumida }}</span>
          <img src="{{ asset("imagem/icons8-relampago-50.png")  }}" alt="">
        @else 
            <span style="color: #ee2525">OFF</span>
        @endif
          <p style="color: #ee2525"> WATSS</p>
        </div>
        
        <div class="card" style="position: relative; text-align: center; border: 1px solid #7ff17f; border-radius: 10px; padding: 20px;">
          <h3 style="color:#7ff17f;">Carga atual da bateria</h3>
          
          @if(isset($tensao))

              <progress class="progress" value="{{ $tensao }}" max="18"></progress>
              <div id="data-container">Carregando...</div><span>%</span>
             <img src="{{ asset("imagem/icons8-bateria-android-l-50.png")  }}" alt="">

           @else 
           <img src="{{ asset("imagem/icons8-bateria-android-l-50.png")  }}" alt="">
           <progress class="progress" value="00" max="100"></progress>
           <span > OFF</span>
  

           @endif
        
          
        </div>
        </div>

      <!-- FIN CARDS -->


      @endif


  
       
        @if(isset($chart))
        <div style="width: 100%; height:49%;">
          {!! $chart->container() !!}
        </div>
        @else 
              @yield("content")
        @endif


       
    </section>
  </div>
  <script src="{{ asset("js/chart.min.js") }}" charset="utf-8"></script>
  
  <script>
  document.addEventListener('DOMContentLoaded', function() {
            function fetchData() {
                fetch('/getNivelDeTensao')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        document.getElementById('data-container').innerText = `Value: ${((data.value * 100) / 18).toFixed(1)}`;
                    })
                    .catch(error => console.error('Erro:', error));
            }

            // Chama a função fetchData a cada 5 segundos
            setInterval(fetchData, 3000);

            // Chama fetchData imediatamente para não esperar os 5 segundos iniciais
            fetchData();
        });

        document.addEventListener('DOMContentLoaded', function() {
            function fetchData() {
                fetch('/getNivelDeTensaoPainel')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        document.getElementById('data-container-tensao1').innerText = `Value: ${((data.value * 100) / 12).toFixed(1)}`;
                    })
                    .catch(error => console.error('Erro:', error));
            }

            // Chama a função fetchData a cada 5 segundos
            setInterval(fetchData, 3000);

            // Chama fetchData imediatamente para não esperar os 5 segundos iniciais
            fetchData();
        });
  
  </script>
 
  @if(isset($chart))
    {!! $chart->script() !!}
  @else 

  @endif


</body>
</html>
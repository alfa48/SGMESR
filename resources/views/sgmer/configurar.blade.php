
@extends("home")
@section("title","painel de control -> configurar")
@section("tema","Pagina de Configurações")
@section("content")

<div class="container">
    <div class="config-section">
        <h3 style="color: #4a229e;"><i class=""></i> Configurações Gerais</h3>
       
        <form action="{{ route("config") }}">
       
            <div class="input-group">
            <label for="language"><img src="{{ asset("imagem/icons8-global-64.png")  }}" alt=""></img> Idioma:</label>
            <select id="language" name="language">
                <option value="pt">Português</option>
                <option value="en">English</option>
                <!-- Adicionar outros idiomas conforme necessário -->
            </select>
        </div>

        <div class="input-group">
            <label for="units"><img src="{{ asset("imagem/icons8-measurement-scale-53.png")  }}" alt=""></img> Unidades de Medida:</label>
            <select id="units" name="units">
                <option value="watts">Watts</option>
                <option value="kilowatts">Kilowatts</option>
                <!-- Adicionar outras unidades conforme necessário -->
            </select>
        </div>

        <div class="input-group">
            <label for="timezone"><img src="{{ asset("imagem/icons8-data-analysis-68.png")  }}" alt=""></img> Alterar Grafico:</label>
            <select id="timezone" name="garfico">
                <option  value="bar">Barra</option>
                <option value="line">Linha</option>
                <option value="polarArea">polarArea</option>
                <option value="scatter">scatter</option>
                <option value="doughnut">doughnut</option>
           
                <!-- Adicionar outras opções de fuso horário conforme necessário -->
            </select>
        
        </div>
    </div>

    <div class="config-section">
        <h3 style="color: #4a229e;"><i class=""></i> Configurações de Energia Solar</h3>
        <div class="input-group">
            <label for="system_capacity"><img src="{{ asset("imagem/icons8-painel-solar-64.png")  }}" alt=""></img>Capacidade do Sistema (kW): </label>
            <input type="number" id="system_capacity" name="system_capacity" min="0">
        </div>

        <div class="input-group">
            <label for="operation_mode"><img src="{{ asset("imagem/icons8-configurações-3-50.png")  }}" alt=""></img>Modo de Operação: </label>
            <select id="operation_mode" name="simulacao">
                <option value="economy">Economia de Energia</option>
                <option value="simulation-battery-down">Simulaçao de baixa carga</option>
            </select>

        </div>
    </div>
    <button type="submit" class="btn">guardar</button>
</form>
    <!-- Adicionar outras seções conforme necessário -->
</div>
@endsection

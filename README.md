# API-Enderecos-IBGE

**API LARAVEL INTEGRADA COM API DO IBGE DAS CIDADES DO BRASIL**
# INICIANDO
 - AO BAIXAR O PROJETO RODE O COMPOSER INSTALL (**UTILIZA A BIBLIOTECA guzzlehttp**)
 - NO SEU ENV COLOQUE OS SEGUINTES PARÂMETROS (se voçê é do MS): 
 - **MS = 50**
 - **URL_IBGE = https://servicodados.ibge.gov.br/api/v1/localidades/estados/MS/municipios**
 - NESTE CASO API RETORNA AS CIDADES DO MS 
 - CONSULTE O ID DO SEU ESTADO NESSE [**LINK**](https://servicodados.ibge.gov.br/api/v1/localidades/estados)   
 - Antes de iniciar a aplicação rode as migrations **php artisan migrate**
 - RODE A APLICAÇÃO **php artisan serve**
 - ABRA O POSTMAN OU INSOMNIA 
 - 
 # ENDPOINTS

 - POST http://localhost:8000/api/cidades (**SALVA TODAS CIDADES DO SEU ESTADO)  ==> EXECUTE APENAS UMA VEZ ESSE REQUEST**
 - GET  http://localhost:8000/api/cidades (**TRAZ TODAS CIDADES SALVAS NO BD**)
 - 
 - **PARA  CADASTRAR UM ENDERECO UM JSON COM ESSES CAMPOS DEVEM SER ENVIADOS (colocar no Header -> Accept -> application/json**
 - POST http://localhost:8000/api/endereco  
 -  {
	  "logradouro": "Rua BAire",
	  "numero": 122,
	  "bairro": "Araus",
	  "cidade_id": 5
    }

- GET http://localhost:8000/api/endereco **LISTA OS ENDERECOS SALVOS**
- GET http://localhost:8000/api/cadastros **LISTA OS CADASTROS SALVOS  
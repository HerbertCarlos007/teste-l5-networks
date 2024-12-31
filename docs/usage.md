## Configuração do Ambiente

## 1. Crie um arquivo `.env` na raiz do projeto nas pasta backend e adicione os seguintes campos com as configurações adequadas:

   ```
   API_URL= <URL da sua API, use esse valor: https://swapi.py4e.com/api/films>
   DB_DRIVER= <Tipo de driver do banco, ex: mysql>
   DB_HOST= <Endereço do servidor de banco de dados>
   DB_NAME= <Nome do banco de dados>
   DB_USERNAME= <Nome de usuário do banco de dados>
   DB_PASSWORD= <Senha do banco de dados>
   ```

   **Observação:** Você precisa criar o banco de dados mencionado no campo `DB_NAME`. Como exemplo, você pode criar um banco de dados chamado `starwars` no MySQL.

   Para criar o banco de dados, você pode executar o seguinte comando no MySQL:

   ```sql
   CREATE DATABASE starwars;
   ```

2. Colocando o Backend no diretório htdocs do XAMPP:

    Coloque a pasta do backend, dentro desse diretorio: C:\xampp\htdocs\

    **Observação:** Você precisa saber a localização do seu XAMPP, se for preciso altere o diretorio.


3. Instalar o Liver Server no frontend:

    - Abra o menu lateral esquerdo, clique em **Extensões**.
    - Na barra de pesquisa, digite `Live Server`.
    - Clique em **Instalar** na extensão chamada **Live Server** (desenvolvida por Ritwick Dey).


## 2. Abrindo o Frontend com o Live Server

Após configurar o que foi dito anteriormente, siga esses passos:

1. **Abra o Editor de Código**: Abra a pasta do seu projeto frontend no editor de código (por exemplo, [Visual Studio Code](https://code.visualstudio.com/)).

2. **Abrir o Arquivo `index.html` com o Live Server**:
   - Navegue até a pasta do seu frontend.
   - Localize o arquivo `index.html`.
   - Clique com o botão direito sobre o arquivo e selecione a opção **Open with Live Server**.

3. **Visualização no Navegador**:
   - O Live Server abrirá automaticamente uma nova aba no seu navegador, onde você poderá ver a aplicação frontend rodando.


## Rotas da API

1. **GET** `/backend/index.php/movies`
2. **GET** `/backend/index.php/movies?title={title}`
3. **GET** `/backend/index.php/movies/favorites`
4. **GET** `/backend/index.php/movies/{id}`
5. **PUT** `/backend/index.php/movies/{id}/favorite`







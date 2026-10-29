<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apresentação Institucional - LGBT Software</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Press+Start+2P&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #3A0CA3;
            --primary-purple: #7B2CBF;
            --accent-cyan: #4CC9F0;
            --bg-light: #F8F9FA;
            --card-bg: #FFFFFF;
            --text-color: #2B2D42;
            --text-muted: #6C757D;
            --border-color: #E9ECEF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-color);
            line-height: 1.6;
            padding: 40px 20px;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            border: 1px solid var(--border-color);
        }

        header {
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 40px;
        }

        .doc-logo {
            max-width: 200px;
            height: auto;
            margin: 0 auto 20px auto;
            display: block;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15));
        }

        .brand-title {
            font-family: 'Press Start 2P', cursive;
            font-size: 26px;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .brand-subtitle {
            font-size: 15px;
            color: var(--text-muted);
            font-weight: 400;
        }

        h2 {
            font-size: 18px;
            color: var(--primary-blue);
            margin-top: 30px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #F0F0F0;
            padding-bottom: 8px;
        }

        p, li {
            font-size: 14px;
            color: var(--text-color);
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 10px;
        }

        ul li::before {
            content: "•";
            color: var(--primary-purple);
            font-weight: bold;
            font-size: 18px;
            position: absolute;
            left: 0;
            top: -2px;
        }

        /* Tabelas */
        .doc-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 13px;
        }

        .doc-table th {
            background-color: var(--primary-blue);
            color: #FFFFFF;
            text-align: left;
            padding: 12px 16px;
            font-weight: 600;
        }

        .doc-table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .doc-table tr:nth-child(even) {
            background-color: #FDFDFD;
        }

        /* Diagrama ASCII / Bloco de Código */
        .diagram-box {
            background: #1E1E2E;
            color: #A6ADC8;
            font-family: monospace;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
            font-size: 12px;
            line-height: 1.4;
            margin: 20px 0;
            border-left: 4px solid var(--primary-purple);
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-rf {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .badge-rnf {
            background: #E3F2FD;
            color: #1565C0;
        }

        .footer-info {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 12px;
            color: var(--text-muted);
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            .brand-title {
                font-size: 18px;
            }
            .doc-table {
                font-size: 11px;
            }
            .doc-logo {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Cabeçalho com Logo Atualizada -->
        <header>
            <img src="assets/logo.png" alt="logo" class="doc-logo">
            <div class="brand-title">LGBT SOFTWARE</div>
            <div class="brand-subtitle">Soluções em Desenvolvimento, Arquitetura Web e Experiências Interativas</div>
        </header>

        <!-- 1. Resumo Executivo -->
        <section>
            <h2>1. RESUMO EXECUTIVO</h2>
            <p>
                A <strong>LGBT Software</strong> é uma empresa especializada no projeto, desenvolvimento e manutenção de sistemas web, soluções de software sob medida e experiências digitais interativas. Focada em inovação tecnológica, a empresa combina arquiteturas de backend robustas com interfaces visuais dinâmicas e de alta performance.
            </p>
            <p style="margin-top: 10px;">
                Com expertise em <strong>Full Stack Development</strong> (PHP, MySQL, JavaScript moderno e CSS3 avançado), a LGBT Software atua desde a fase de levantamento de requisitos até a implantação final de plataformas acessíveis, ágeis e escaláveis.
            </p>
        </section>

        <!-- 2. Visão, Missão e Valores -->
        <section>
            <h2>2. VISÃO, MISSÃO E VALORES</h2>
            <ul>
                <li><strong>Missão:</strong> Transformar ideias e requisitos complexos em softwares intuitivos, seguros e de alto desempenho, entregando valor real a usuários e parceiros comerciais.</li>
                <li><strong>Visão:</strong> Ser referência no desenvolvimento de aplicações web leves e sistemas interativos que combinem engenharia de código limpo com excelente usabilidade.</li>
                <li><strong>Valores:</strong>
                    <br>• <em>Qualidade de Código:</em> Adoção de boas práticas, padronização e prevenção de gargalos técnicos.
                    <br>• <em>Inovação Técnica:</em> Utilização de APIs modernas (como Web Animations API) para garantir fluidez total em gráficos e animações.
                    <br>• <em>Transparência e Mapeamento:</em> Documentação rigorosa de Requisitos Funcionais e Não Funcionais em todos os projetos.
                </li>
            </ul>
        </section>

        <!-- 3. Portfólio de Serviços -->
        <section>
            <h2>3. PORTFÓLIO DE SERVIÇOS</h2>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">SERVIÇO</th>
                        <th style="width: 45%;">DESCRIÇÃO</th>
                        <th style="width: 25%;">TECNOLOGIAS CHAVE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Desenvolvimento Web Full Stack</strong></td>
                        <td>Criação de plataformas e portais dinâmicos com processamento em tempo real.</td>
                        <td>PHP 8+, MySQL, HTML5, CSS3</td>
                    </tr>
                    <tr>
                        <td><strong>Integração de Banco de Dados</strong></td>
                        <td>Modelagem relacional, persistência de dados e segurança contra invasões.</td>
                        <td>PDO, Prepared Statements, MySQL</td>
                    </tr>
                    <tr>
                        <td><strong>Aplicações Interativas & Gamificação</strong></td>
                        <td>Desenvolvimento de jogos browser-based e sistemas com mecânicas de engajamento.</td>
                        <td>JavaScript (ES6+), Web Animations API, Fetch API</td>
                    </tr>
                    <tr>
                        <td><strong>UI/UX & Responsividade</strong></td>
                        <td>Layouts customizados para desktop e dispositivos móveis, sem dependência de frameworks pesados.</td>
                        <td>CSS Keyframes, Flexbox, CSS Grid</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- 4. Case de Sucesso -->
        <section>
            <h2>4. CASE DE SUCESSO: YOSHI'S EGG DASH</h2>
            <p>
                Como demonstração de capacidade técnica e integração Full Stack, a LGBT Software projetou e implantou o jogo browser-based <strong>Yoshi's Egg Dash</strong>.
            </p>

            <div class="diagram-box">
+-----------------------------------------------------------------------+
|                          YOSHI'S EGG DASH                             |
|                                                                       |
|  [HUD: Jogador | Nível Dinâmico | Ovos Coletados | Pontuação Global]  |
|  +-----------------------------------------------------------------+  |
|  | [Nuvens - Loop Seamless 1000px]                                 |  |
|  |                                                                 |  |
|  |  (Yoshi/Sprite)  --->  [Ovo +50pts]  --->  [Obstáculo/Palm]     |  |
|  +-----------------------------------------------------------------+  |
|                                                                       |
|  [Motor de Animação: Web Animations API | Backend: PHP / MySQL PDO]    |
+-----------------------------------------------------------------------+
            </div>

            <ul>
                <li><strong>Zero Teletransporte Visual:</strong> Resolução de travamentos de animação durante o ganho de velocidade através do método <code>updatePlaybackRate</code> da <em>Web Animations API</em>.</li>
                <li><strong>Progressão de Dificuldade Dinâmica:</strong> Sistema automático de escalonamento codificado em 5 níveis mapeados: <strong>FÁCIL</strong>, <strong>MÉDIO</strong>, <strong>DIFÍCIL</strong>, <strong>EXPERT</strong> e <strong>INSANO ⚡</strong>.</li>
                <li><strong>Persistência Assíncrona:</strong> Gravação e consulta em tempo real do <strong>Top 10 Ranking Global</strong> conectado ao banco MySQL via <code>salvar_ranking.php</code> e <code>obter_ranking.php</code>.</li>
                <li><strong>Navegação Integrada:</strong> Redirecionamento e integração com a página institucional <em>Sobre Nós</em>.</li>
            </ul>
        </section>

        <!-- 5. Resumo de Requisitos Técnicos -->
        <section>
            <h2>5. RESUMO DE REQUISITOS TÉCNICOS DO PROJETO</h2>
            
            <h3 style="font-size: 14px; margin-top: 15px; color: var(--primary-purple);">Requisitos Funcionais (RF)</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">CÓDIGO</th>
                        <th style="width: 35%;">FUNCIONALIDADE</th>
                        <th style="width: 50%;">DESCRIÇÃO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>RF-01</strong></td>
                        <td><span class="badge badge-rf">Identificação</span></td>
                        <td>Cadastro e captura do nome do jogador via modal de entrada.</td>
                    </tr>
                    <tr>
                        <td><strong>RF-02</strong></td>
                        <td><span class="badge badge-rf">Customização</span></td>
                        <td>Seleção dinâmica de avatar (Yoshi Green, Rainbow Yoshi, Chain Chomp).</td>
                    </tr>
                    <tr>
                        <td><strong>RF-03</strong></td>
                        <td><span class="badge badge-rf">Física de Salto</span></td>
                        <td>Execução de pulo via teclado (Espaço, Seta para Cima) ou clique no tabuleiro.</td>
                    </tr>
                    <tr>
                        <td><strong>RF-04</strong></td>
                        <td><span class="badge badge-rf">Coletáveis</span></td>
                        <td>Spawn contínuo de itens bônus que somam +50 pontos ao placar.</td>
                    </tr>
                    <tr>
                        <td><strong>RF-05</strong></td>
                        <td><span class="badge badge-rf">Ranking MySQL</span></td>
                        <td>Persistência automática da pontuação final e renderização do placar global.</td>
                    </tr>
                </tbody>
            </table>

            <h3 style="font-size: 14px; margin-top: 20px; color: var(--primary-purple);">Requisitos Não Funcionais (RNF)</h3>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">CÓDIGO</th>
                        <th style="width: 35%;">CATEGORIA</th>
                        <th style="width: 50%;">ESPECIFICAÇÃO TÉCNICA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>RNF-01</strong></td>
                        <td><span class="badge badge-rnf">Performance</span></td>
                        <td>Execução constante a 60 FPS com manipulação de chave de animação em tempo de execução.</td>
                    </tr>
                    <tr>
                        <td><strong>RNF-02</strong></td>
                        <td><span class="badge badge-rnf">Segurança</span></td>
                        <td>Sanitização de dados de entrada (htmlspecialchars) e prevenção de SQL Injection via PDO.</td>
                    </tr>
                    <tr>
                        <td><strong>RNF-03</strong></td>
                        <td><span class="badge badge-rnf">Continuidades</span></td>
                        <td>Imagem de fundo renderizada com ciclo seamless em repetição de 1000px.</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Rodapé / Informações Corporativas -->
        <footer class="footer-info">
            <div><strong>Razão Social:</strong> LGBT Software LTDA.</div>
            <div><strong>Especialidade:</strong> Desenvolvimento & Arquitetura Web</div>
            <div><strong>Status do Servidor:</strong> Conectado & Operacional (MySQL)</div>
        </footer>
    </div>

</body>
</html>
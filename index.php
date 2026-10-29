<?php
require_once 'conexao.php';

$rankingInicial = [];
try {
    $stmt = $pdo->query("
        SELECT id, nome, pontos, DATE_FORMAT(data_registro, '%d/%m/%Y %H:%i') as data 
        FROM ranking 
        ORDER BY pontos DESC, id ASC 
        LIMIT 10
    ");
    $rankingInicial = $stmt->fetchAll();
} catch (Exception $e) {
    $rankingInicial = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yoshi's Egg Dash - LGBT Software</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=17.0">
</head>
<body>

    <div class="game-container">
        <!-- HUD / Barra Superior com Nível de Dificuldade -->
        <header class="hud-bar">
            <div class="player-info">
                <span class="label">JOGADOR:</span>
                <span class="value" id="hud-player-name">---</span>
            </div>
            <div class="hud-item">
                <span class="label">NÍVEL:</span>
                <span class="value level-easy" id="difficulty-display">FÁCIL</span>
            </div>
            <div class="hud-item">
                <span class="label">OVOS:</span>
                <span class="value" id="eggs-display">0</span>
            </div>
            <div class="score-info">
                <span class="label">PONTOS:</span>
                <span class="value" id="score-display">0</span>
            </div>
        </header>

        <!-- Tabuleiro do Jogo -->
        <main class="game-board" id="game-board">
            <img src="assets/yoshi-clouds.png" class="clouds" alt="Nuvens">
            <img src="assets/yoshi.gif" class="mario" alt="Yoshi">
            <img src="assets/palm.png" class="pipe" alt="Obstáculo">
            <img src="assets/yoshi-egg.png" class="collectible" id="collectible-item" alt="Ovo Yoshi">

            <span class="jump-tip" id="jump-tip">Pressione ESPAÇO ou clique para pular</span>
        </main>
    </div>
        
    <!-- 1. TELA DE INÍCIO -->
    <div class="modal-overlay active" id="start-modal">
        <div class="modal-card">
            <div class="modal-header">
                <h1 class="game-title">YOSHI'S EGG DASH</h1>
                <p class="game-subtitle">Corra, desvie dos obstáculos, colete ovos e dispute o topo do ranking!</p>
            </div>

            <form class="start-form" id="start-form">
                <div class="input-group">
                    <label for="player-input">DIGITE SEU NOME:</label>
                    <input 
                        type="text" 
                        id="player-input" 
                        placeholder="Ex: Seu Nome" 
                        maxlength="30" 
                        required 
                        autocomplete="off"
                        autofocus
                    >
                </div>
                <div class="character-selection">
                    <label class="selection-title">ESCOLHA SEU PERSONAGEM:</label>
                    <div class="character-options">
                        <label class="char-card active">
                            <input type="radio" name="character" value="assets/yoshi.gif" checked>
                            <img src="assets/yoshi.gif" alt="Yoshi Verde">
                            <span>Yoshi</span>
                        </label>
                        <label class="char-card">
                            <input type="radio" name="character" value="assets/yoshi-rainbow.gif">
                            <img src="assets/yoshi-rainbow.gif" alt="Yoshi Rainbow">
                            <span>Rainbow</span>
                        </label>
                        <label class="char-card">
                            <input type="radio" name="character" value="assets/chomp.gif">
                            <img src="assets/chomp.gif" alt="Chain Chomp">
                            <span>Chomp</span>
                        </label>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn btn-primary" id="btn-start">INICIAR JOGO</button>
                    <button type="button" class="btn btn-secondary" id="btn-view-ranking">VER RANKING</button>
                    <a href="sobre.php" class="btn btn-info">SOBRE NÓS</a>
                </div>
            </form>

            <div class="server-status" id="server-status">
                <span class="status-dot online"></span> Conectado ao MySQL | LGBT Software
            </div>
        </div>
    </div>

    <!-- 2. TELA DE GAME OVER & RANKING -->
    <div class="modal-overlay" id="gameover-modal">
        <div class="modal-card gameover-card">
            <div class="modal-header">
                <h2 class="gameover-title">GAME OVER</h2>
                <div class="final-score-box">
                    <div class="final-score-label">SUA PONTUAÇÃO</div>
                    <div class="final-score-num" id="final-score-value">0</div>
                    <div class="save-status" id="save-status-msg"></div>
                </div>
            </div>

            <div class="ranking-container">
                <h3 class="ranking-title">🏆 TOP 10 MELHORES PONTUAÇÕES</h3>
                <div class="table-wrapper">
                    <table class="ranking-table">
                        <thead>
                            <tr>
                                <th>POS</th>
                                <th>JOGADOR</th>
                                <th>PONTUAÇÃO</th>
                            </tr>
                        </thead>
                        <tbody id="ranking-body">
                            <?php if (!empty($rankingInicial)): ?>
                                <?php foreach ($rankingInicial as $i => $row): ?>
                                    <tr>
                                        <td class="ranking-pos">
                                            <?= $i === 0 ? '🥇 1º' : ($i === 1 ? '🥈 2º' : ($i === 2 ? '🥉 3º' : ($i + 1) . 'º')) ?>
                                        </td>
                                        <td><strong><?= htmlspecialchars($row['nome']) ?></strong></td>
                                        <td><?= (int)$row['pontos'] ?> pts</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="loading-cell">Nenhuma pontuação gravada ainda. Jogue para ser o 1º!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-primary" id="btn-restart">JOGAR NOVAMENTE</button>
                <button type="button" class="btn btn-secondary" id="btn-change-player">TROCAR JOGADOR</button>
                <a href="sobre.php" class="btn btn-info">SOBRE NÓS</a>
            </div>
        </div>
    </div>

    <!-- Overlay Game Over Tela Cheia -->
    <div class="fullscreen-gameover-overlay" id="fullscreen-gameover">
        <img src="assets/game-over.jpeg" alt="Game Over">
    </div>

    <!-- Áudios do Jogo -->
    <audio id="bg-music" src="assets/bg-music.mp3" preload="auto" loop></audio>
    <audio id="game-over-sound-mortis" src="assets/game-over-sound-mortis.mp3" preload="auto"></audio>

    <script src="js/script.js?v=17.0"></script>
</body>
</html>
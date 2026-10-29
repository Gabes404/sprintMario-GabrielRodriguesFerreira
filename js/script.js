/**
 * Yoshi's Egg Dash - Lógica do Jogo
 */

document.addEventListener('DOMContentLoaded', () => {
    // Elementos do Jogo
    const mario = document.querySelector('.mario');
    const pipe = document.querySelector('.pipe');
    const item = document.getElementById('collectible-item');
    const gameBoard = document.getElementById('game-board');
    const hudPlayerName = document.getElementById('hud-player-name');
    const scoreDisplay = document.getElementById('score-display');
    const eggsDisplay = document.getElementById('eggs-display');
    const difficultyDisplay = document.getElementById('difficulty-display');
    const jumpTip = document.getElementById('jump-tip');

    // Áudios
    const bgMusic = document.getElementById('bg-music') || document.getElementById('bg-music.mp3');
    const gameOverSound = document.getElementById('game-over-sound-mortis') || document.getElementById('game-over-sound');

    // Modais e Telas
    const startModal = document.getElementById('start-modal');
    const startForm = document.getElementById('start-form');
    const playerInput = document.getElementById('player-input');
    const btnViewRanking = document.getElementById('btn-view-ranking');

    const gameoverModal = document.getElementById('gameover-modal');
    const fullscreenGameOver = document.getElementById('fullscreen-gameover');
    const finalScoreValue = document.getElementById('final-score-value');
    const saveStatusMsg = document.getElementById('save-status-msg');
    const rankingBody = document.getElementById('ranking-body');
    const btnRestart = document.getElementById('btn-restart');
    const btnChangePlayer = document.getElementById('btn-change-player');

    // Variáveis de Estado
    let currentPlayer = '';
    let score = 0;
    let eggs = 0;
    let isPlaying = false;
    let gameLoop = null;
    let scoreLoop = null;

    // Personagem Selecionado
    let selectedCharacter = localStorage.getItem('mario_jump_char') || 'assets/yoshi.gif';

    // Seleção de Personagem
    const characterRadios = document.querySelectorAll('input[name="character"]');

    function updateCharacterSelection() {
        characterRadios.forEach(radio => {
            const card = radio.closest('.char-card');
            if (card) {
                if (radio.checked) {
                    card.classList.add('active');
                    selectedCharacter = radio.value;
                    localStorage.setItem('mario_jump_char', selectedCharacter);
                } else {
                    card.classList.remove('active');
                }
            }
        });
    }

    characterRadios.forEach(radio => {
        radio.addEventListener('change', updateCharacterSelection);
    });

    const savedChar = localStorage.getItem('mario_jump_char');
    if (savedChar) {
        const targetRadio = document.querySelector(`input[name="character"][value="${savedChar}"]`);
        if (targetRadio) {
            targetRadio.checked = true;
            updateCharacterSelection();
        }
    }

    // Recupera último nome utilizado
    const savedName = localStorage.getItem('mario_jump_player');
    if (savedName && playerInput) {
        playerInput.value = savedName;
    }

    /**
     * Retorna o nome e a classe visual consoante a pontuação
     */
    function getDifficultyTier(currentScore) {
        if (currentScore < 200) {
            return { name: 'FÁCIL', class: 'level-easy' };
        } else if (currentScore < 500) {
            return { name: 'MÉDIO', class: 'level-medium' };
        } else if (currentScore < 900) {
            return { name: 'DIFÍCIL', class: 'level-hard' };
        } else if (currentScore < 1400) {
            return { name: 'EXPERT', class: 'level-expert' };
        } else {
            return { name: 'INSANO ⚡', class: 'level-insane' };
        }
    }

    /**
     * Ajusta a velocidade do obstáculo em tempo real sem teleporte
     */
    function adjustDifficulty(currentScore) {
        const PONTOS_INICIAIS = 200;
        const initialDuration = 1.6;
        let targetDuration = initialDuration;

        if (currentScore > PONTOS_INICIAIS) {
            const pontosExtras = currentScore - PONTOS_INICIAIS;
            const speedDecrease = Math.floor(pontosExtras / 100) * 0.1;
            targetDuration = Math.max(0.7, initialDuration - speedDecrease);
        }

        // Web Animations API: altera playbackRate sem quebrar o ciclo atual
        const animations = pipe.getAnimations();
        if (animations.length > 0) {
            const newRate = initialDuration / targetDuration;
            if (animations[0].playbackRate !== newRate) {
                animations[0].updatePlaybackRate(newRate);
            }
        }

        // Atualiza a Dificuldade visível no HUD
        if (difficultyDisplay) {
            const tier = getDifficultyTier(currentScore);
            if (difficultyDisplay.textContent !== tier.name) {
                difficultyDisplay.textContent = tier.name;
                difficultyDisplay.className = `value ${tier.class}`;
            }
        }
    }

    /**
     * Inicia uma nova rodada
     */
    function startGame() {
        clearInterval(gameLoop);
        clearInterval(scoreLoop);

        resetElements();

        isPlaying = true;
        score = 0;
        eggs = 0;

        scoreDisplay.textContent = '0';
        if (eggsDisplay) eggsDisplay.textContent = '0';
        hudPlayerName.textContent = currentPlayer || 'Jogador';

        if (difficultyDisplay) {
            difficultyDisplay.textContent = 'FÁCIL';
            difficultyDisplay.className = 'value level-easy';
        }

        if (bgMusic) {
            bgMusic.currentTime = 0;
            bgMusic.play().catch(err => console.log('Autoplay bloqueado pelo navegador:', err));
        }

        gameBoard.classList.add('running');

        const animations = pipe.getAnimations();
        if (animations.length > 0) {
            animations[0].updatePlaybackRate(1.0);
        }

        scoreLoop = setInterval(() => {
            if (isPlaying) {
                score += 1;
                scoreDisplay.textContent = score;
                adjustDifficulty(score);
            }
        }, 100);

        gameLoop = setInterval(checkCollision, 10);
    }

    function resetElements() {
        if (bgMusic) {
            bgMusic.pause();
            bgMusic.currentTime = 0;
        }
        if (gameOverSound) {
            gameOverSound.pause();
            gameOverSound.currentTime = 0;
        }

        pipe.style.animation = '';
        pipe.style.left = '';

        if (item) {
            item.style.animation = '';
            item.style.display = 'block';
        }

        mario.src = selectedCharacter;
        mario.style.animation = '';
        mario.style.bottom = '';
        mario.style.width = '';
        mario.style.marginLeft = '';
        mario.classList.remove('jump');

        if (jumpTip) {
            jumpTip.style.opacity = '1';
        }
    }

    function jump() {
        if (!isPlaying || mario.classList.contains('jump')) return;

        mario.style.bottom = '';
        mario.classList.add('jump');

        if (jumpTip) {
            jumpTip.style.opacity = '0';
        }

        const onJumpEnd = () => {
            mario.classList.remove('jump');
            mario.removeEventListener('animationend', onJumpEnd);
        };

        mario.addEventListener('animationend', onJumpEnd);
    }

    function checkCollision() {
        if (!isPlaying) return;

        const pipePosition = pipe.offsetLeft;
        const marioPosition = +window.getComputedStyle(mario).bottom.replace('px', '');

        // Colisão com o obstáculo
        if (pipePosition <= 80 && pipePosition > 0 && marioPosition < 80) {
            triggerGameOver(pipePosition, marioPosition);
            return;
        }

        // Coleta do ovo (+50 pontos)
        if (item && item.style.display !== 'none') {
            const itemPosition = item.offsetLeft;

            if (itemPosition <= 110 && itemPosition > 20 && marioPosition >= 70) {
                eggs += 1;
                score += 50;

                if (eggsDisplay) eggsDisplay.textContent = eggs;
                scoreDisplay.textContent = score;

                item.style.display = 'none';
                setTimeout(() => {
                    if (isPlaying) {
                        item.style.display = 'block';
                    }
                }, 2500);
            }
        }
    }

    function triggerGameOver(pipePosition, marioPosition) {
        isPlaying = false;
        clearInterval(gameLoop);
        clearInterval(scoreLoop);

        if (bgMusic) {
            bgMusic.pause();
            bgMusic.currentTime = 0;
        }

        if (gameOverSound) {
            gameOverSound.currentTime = 0;
            gameOverSound.play().catch(err => console.log('Erro ao tocar áudio de Game Over:', err));
        }

        gameBoard.classList.remove('running');

        pipe.style.animation = 'none';
        pipe.style.left = `${pipePosition}px`;

        if (item) {
            item.style.animation = 'none';
        }

        mario.style.animation = 'none';
        mario.style.bottom = `${marioPosition}px`;
        mario.src = 'assets/yoshi-game-over.gif';

        saveScore(currentPlayer, score);

        if (fullscreenGameOver) {
            fullscreenGameOver.classList.add('active');
        }

        setTimeout(() => {
            if (fullscreenGameOver) {
                fullscreenGameOver.classList.remove('active');
            }

            finalScoreValue.textContent = score;
            gameoverModal.classList.add('active');
        }, 7000);
    }

    function saveScore(playerName, finalScore) {
        fetch('salvar_ranking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nome: playerName,
                pontos: finalScore
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                saveStatusMsg.textContent = 'Pontuação registrada no banco!';
                saveStatusMsg.style.color = '#2E7D32';
                if (data.ranking) {
                    renderRanking(data.ranking, playerName, finalScore);
                }
            } else {
                saveStatusMsg.textContent = '⚠️ ' + (data.message || 'Erro ao registrar.');
                saveStatusMsg.style.color = '#D32F2F';
            }
        })
        .catch(err => {
            console.error('Erro na requisição:', err);
            saveStatusMsg.textContent = '⚠️ Erro ao conectar ao servidor Laragon.';
            saveStatusMsg.style.color = '#D32F2F';
        });
    }

    function fetchRanking() {
        fetch('obter_ranking.php')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.ranking) {
                    renderRanking(data.ranking);
                }
            })
            .catch(err => console.error('Erro ao buscar ranking:', err));
    }

    function renderRanking(list, highlightName = null, highlightScore = null) {
        if (!rankingBody) return;
        rankingBody.innerHTML = '';

        if (!list || list.length === 0) {
            rankingBody.innerHTML = '<tr><td colspan="3" class="loading-cell">Nenhuma pontuação gravada ainda. Jogue para ser o 1º!</td></tr>';
            return;
        }

        let highlighted = false;

        list.forEach((item, index) => {
            const tr = document.createElement('tr');

            if (!highlighted && highlightName && item.nome === highlightName && parseInt(item.pontos, 10) === highlightScore) {
                tr.classList.add('highlight-current');
                highlighted = true;
            }

            let medal = `${index + 1}º`;
            if (index === 0) medal = '🥇 1º';
            else if (index === 1) medal = '🥈 2º';
            else if (index === 2) medal = '🥉 3º';

            tr.innerHTML = `
                <td class="ranking-pos">${medal}</td>
                <td><strong>${escapeHtml(item.nome)}</strong></td>
                <td>${parseInt(item.pontos, 10)} pts</td>
            `;

            rankingBody.appendChild(tr);
        });
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Eventos do Formulário de Início
    startForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const nameValue = playerInput.value.trim();
        if (!nameValue) {
            playerInput.focus();
            return;
        }

        const checkedRadio = document.querySelector('input[name="character"]:checked');
        if (checkedRadio) {
            selectedCharacter = checkedRadio.value;
            localStorage.setItem('mario_jump_char', selectedCharacter);
        }

        currentPlayer = nameValue;
        localStorage.setItem('mario_jump_player', currentPlayer);

        startModal.classList.remove('active');
        startGame();
    });

    // Botões dos Modais
    btnViewRanking.addEventListener('click', () => {
        fetchRanking();
        finalScoreValue.textContent = '---';
        saveStatusMsg.textContent = '';
        startModal.classList.remove('active');
        gameoverModal.classList.add('active');
    });

    btnRestart.addEventListener('click', () => {
        gameoverModal.classList.remove('active');
        if (!currentPlayer) {
            startModal.classList.add('active');
            playerInput.focus();
        } else {
            startGame();
        }
    });

    btnChangePlayer.addEventListener('click', () => {
        gameoverModal.classList.remove('active');
        resetElements();
        startModal.classList.add('active');
        playerInput.value = '';
        playerInput.focus();
    });

    // Controles
    document.addEventListener('keydown', (e) => {
        if (e.code === 'Space' || e.key === ' ' || e.code === 'ArrowUp') {
            if (isPlaying) {
                e.preventDefault();
                jump();
            }
        }
    });

    if (gameBoard) {
        gameBoard.addEventListener('click', jump);
    }
});
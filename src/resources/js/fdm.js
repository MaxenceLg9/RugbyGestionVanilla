const players = Array.from(document.querySelectorAll('.player-card'));
const slots = Array.from(document.querySelectorAll('.position-slot'));
const fieldNbJoueurs = document.getElementById('fieldNbJoueurs');
const fieldNbPremieresLignes = document.getElementById('fieldNbPremieresLignes');
const joueurs = document.getElementById('players');

let draggedPlayer = null;

let nbJoueurs = 0;
let nbPremieresLignes = 0;

fieldNbJoueurs.innerHTML = nbJoueurs.toString();
fieldNbPremieresLignes.innerHTML = nbPremieresLignes.toString();

players.forEach(player => {
    player.addEventListener('dragstart', (e) => {
        draggedPlayer = player;
        setTimeout(() => player.classList.add('dragging'), 0)
    });

    player.addEventListener('dragend', (e) => {
        draggedPlayer = null;
        player.classList.remove('dragging');
    });
});

// Add dragover and drop event listeners to the "joueurs" container
joueurs.addEventListener('dragover', (e) => e.preventDefault());

joueurs.addEventListener('drop', (e) => {
    e.preventDefault();
    joueurs.appendChild(draggedPlayer); // Return player to the "joueurs" container
});

// Add drag-and-drop behavior to each slot
slots.forEach(slot => {
    // Allow drop on the slot
    slot.addEventListener('dragover', (e) => e.preventDefault());

    slot.addEventListener('drop', function (e) {
        e.preventDefault();

        if (draggedPlayer) {
            const playerId = draggedPlayer.querySelector('input[name="id"]').value;
            const playerPremiereLigne = draggedPlayer.querySelector('input[name="premiereLigne"]').value === '1';

            // Find the hidden input for this slot and set its value
            const hiddenInput = this.nextElementSibling;
            if (hiddenInput && hiddenInput.type === 'hidden') {
                hiddenInput.value = playerId;

                if (this.children.length === 0) {
                    // Slot was empty; update counts
                    updateCounts(playerPremiereLigne, 1);
                } else {
                    // Slot was occupied; handle swapping logic
                    const existingPlayer = this.firstElementChild;
                    const existingPremiereLigne = existingPlayer.querySelector('input[name="premiereLigne"]').value === '1';

                    // Return the existing player to "joueurs"
                    joueurs.appendChild(existingPlayer);

                    // Adjust counts based on swapping
                    if (playerPremiereLigne && !existingPremiereLigne) {
                        nbPremieresLignes++;
                    } else if (!playerPremiereLigne && existingPremiereLigne) {
                        nbPremieresLignes--;
                    }
                }

                // Add the dragged player to the slot
                this.appendChild(draggedPlayer);

                // Update displayed counts
                updateUI();
            }
        }
    });

    slot.addEventListener('dragleave', (e) => {
        if (draggedPlayer && slot.firstChild === draggedPlayer) {
            // Remove player from the slot
            slot.removeChild(draggedPlayer);

            // Return player to "joueurs"
            joueurs.appendChild(draggedPlayer);

            // Update counts
            const playerPremiereLigne = draggedPlayer.querySelector('input[name="premiereLigne"]').value === '1';
            updateCounts(playerPremiereLigne, -1);

            // Update displayed counts
            updateUI();
        }
    });
});

// Helper function to update counts
function updateCounts(isPremiereLigne, delta) {
    nbJoueurs += delta;
    if (isPremiereLigne) {
        nbPremieresLignes += delta;
    }
}

// Helper function to update UI counts
function updateUI() {
    fieldNbJoueurs.innerHTML = nbJoueurs.toString();
    fieldNbPremieresLignes.innerHTML = nbPremieresLignes.toString();
}

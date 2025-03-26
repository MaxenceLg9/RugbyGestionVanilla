const players = document.querySelectorAll('.player-card');
const slots = document.querySelectorAll('.position-slot');
const fieldNbJoueurs = document.getElementById('fieldNbJoueurs');
const fieldNbPremieresLignes = document.getElementById('fieldNbPremieresLignes');

const inputNbJoueurs = document.getElementById('inputNbJoueurs');
const inputNbPremieresLignes = document.getElementById('inputNbPremieresLignes');
const buttonValider = document.getElementById('buttonValider');

const joueurs = document.getElementById('players');

let draggedPlayer = null;

updateUI();

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
            const playerId = draggedPlayer.querySelector('input[name="idJoueur"]').value;
            const playerPremiereLigne = draggedPlayer.querySelector('input[name="premiereLigne"]').value === '1';

            // Find the hidden input for this slot and set its value
            const hiddenInput = slot.nextElementSibling;
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
        console.log('draggedPlayer:', draggedPlayer);
        console.log('slot.firstChild:', slot.firstChild);
        console.log(slot.firstChild === draggedPlayer);
        if (draggedPlayer && slot.firstChild === draggedPlayer) {
            // Remove player from the slot
            slot.removeChild(draggedPlayer);

            // Return player to "joueurs"
            joueurs.appendChild(draggedPlayer);
            const hiddenInput = slot.nextElementSibling;
            if (hiddenInput && hiddenInput.type === 'hidden') {
                hiddenInput.value = "";
                console.log("hiddenInput.value", hiddenInput.value);
            }
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
    inputNbJoueurs.value = nbJoueurs;
    inputNbPremieresLignes.value = nbPremieresLignes;
    buttonValider.disabled = nbJoueurs < 11 || nbPremieresLignes < 4;
    if(nbJoueurs < 11 || nbPremieresLignes < 4)
        buttonValider.classList.add('disabled');
    else
        buttonValider.classList.remove('disabled');
}
console.log("Players to load");
players.forEach(player => {
    player.addEventListener('dragstart', (e) => {
        draggedPlayer = player;
        setTimeout(() => player.classList.add('dragging'), 0)
    });

    if(archiveMatch === 0)
        player.setAttribute('draggable', 'true');

    player.addEventListener('dragend', (e) => {
        draggedPlayer = null;
        player.classList.remove('dragging');
    });
});

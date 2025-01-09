const players = Array.from(document.querySelectorAll('.player-card'));
const slots = Array.from(document.querySelectorAll('.position-slot'));

let draggedPlayer = null;

players.forEach(player => {
    console.log("A");
    player.addEventListener('dragstart', (e) => {
        draggedPlayer = player;
        setTimeout(() => player.classList.add('dragging'), 0);
        console.log("Drag started:", player);
    });

    player.addEventListener('dragend', (e) => {
        draggedPlayer = null;
        player.classList.remove('dragging');
        console.log("Drag ended:", player);
    });
});

slots.forEach(slot => {
    slot.addEventListener('dragover', (e) => {
        e.preventDefault();
        console.log("Drag over slot:", slot);
    });

    slot.addEventListener('drop', function(e) {
        e.preventDefault();
        if (draggedPlayer) {
            if (this.children.length === 0) { // Check if slot is empty
                this.appendChild(draggedPlayer);
                console.log("Player dropped into slot:", slot);
            } else {
                alert("Slot already occupied!");
                console.log("Slot already occupied:", slot);
            }
        }
    });
});
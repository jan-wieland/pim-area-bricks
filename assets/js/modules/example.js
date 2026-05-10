// Beispiel-Modul
export default class ExampleBrick {
    constructor(element) {
        this.el = element;
        this.init();
    }

    init() {
        // Initialisierung
    }
}

// Auto-Init für alle .pim-area-brick Elemente
document.querySelectorAll('.pim-area-brick').forEach(el => {
    new ExampleBrick(el);
});

<script>
    let hover = document.getElementById("hover");

    // Ce gestionnaire sera exécuté à chaque fois que le curseur
    // se déplacera sur un élément de la liste
    hover.addEventListener("mouseover", function(event) {
        // on met l'accent sur la cible de mouseover
        event.target.style.color = "orange";

        // on change la couleur après quelques instants
        setTimeout(function() {
            event.target.style.color = "black";
        }, 500);
    }, false);
</script>
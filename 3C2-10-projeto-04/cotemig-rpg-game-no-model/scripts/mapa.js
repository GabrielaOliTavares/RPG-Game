document.addEventListener("DOMContentLoaded", () => {

    let loading = false;

    document.addEventListener("keyup", (event) => {
        let direcao = "";
        switch (event.key) {
            case "ArrowUp":
                direcao = "cima";
                break;
            case "ArrowDown":
                direcao = "baixo";
                break;
            case "ArrowLeft":
                direcao = "esquerda";
                break;
            case "ArrowRight":
                direcao = "direita";
                break;                                                
        }

        if (direcao !== "" && !loading) {
            loading = true;
            const backdropLoad = document.querySelector(".backdrop-load");
            backdropLoad.classList.remove("backdrop-load--hidden");
            window.location.href = `jogo.php?acao=movimenta&direcao=${direcao}`;
        }

    });

});
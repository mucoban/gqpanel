/****************** is-in-vp ***************************/

function isInVpInit() {
    const hpackages = document.querySelector(".hpackages");
    if (hpackages) {
        const isInViewPort = hpackages.isInViewPort(300, 400);
        if(!hpackages.classList.contains("in-vp") &&  isInViewPort.status) {
            hpackages.classList.add("in-vp");
        } else if(hpackages.classList.contains("in-vp") &&  !isInViewPort.status) {
            if (!hpackages.classList.contains("out-vp-up") && isInViewPort.dirPos) { hpackages.classList.add("out-vp-up") }
            else if (hpackages.classList.contains("out-vp-up") && !isInViewPort.dirPos) { hpackages.classList.remove("out-vp-up") }
            hpackages.classList.remove("in-vp");
        }
    }

    /*********************/

    const wsslides = document.querySelector(".wsslides");
    if (wsslides) {
        const isInViewPort = wsslides.isInViewPort(300, 500);
        if(!wsslides.classList.contains("in-vp") &&  isInViewPort.status) {
            wsslides.classList.add("in-vp");
        } else if(wsslides.classList.contains("in-vp") &&  !isInViewPort.status) {
            if (!wsslides.classList.contains("out-vp-up") && isInViewPort.dirPos) { wsslides.classList.add("out-vp-up") }
            else if (wsslides.classList.contains("out-vp-up") && !isInViewPort.dirPos) { wsslides.classList.remove("out-vp-up") }
            wsslides.classList.remove("in-vp");
        }
    }

    /*********************/

    const hpprocess  = document.querySelector(".hpprocess ");
    if (hpprocess ) {
        const isInViewPort = hpprocess .isInViewPort(200, 200);
        if(!hpprocess .classList.contains("in-vp") &&  isInViewPort.status) {
            hpprocess .classList.add("in-vp");
        } else if(hpprocess .classList.contains("in-vp") &&  !isInViewPort.status) {
            if (!hpprocess .classList.contains("out-vp-up") && isInViewPort.dirPos) { hpprocess .classList.add("out-vp-up") }
            else if (hpprocess .classList.contains("out-vp-up") && !isInViewPort.dirPos) { hpprocess .classList.remove("out-vp-up") }
            hpprocess .classList.remove("in-vp");
        }
    }

}

/****************** is-in-vp End ***************************/

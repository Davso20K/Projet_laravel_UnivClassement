const body = document.querySelector("body"),
    sidebar = body.querySelector("nav"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
    toggle.disabled = true;

    sidebar.classList.toggle("close");
    sidebar.style.width = sidebar.offsetWidth === 250 ? "100px" : "250px";
    // Réactive le bouton de toggle après une courte période
    setTimeout(() => {
        toggle.disabled = false;
    }, 300); //
});

searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
});

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    } else {
        modeText.innerText = "Dark mode";
    }
});

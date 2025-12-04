import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// star background layer
document.addEventListener("DOMContentLoaded", () => {
    const starLayer = document.getElementById("star-layer");

    const numStars = 60;

    for (let i = 0; i < numStars; i++) {
        const star = document.createElement("div");
        star.classList.add("absolute", "bg-white", "rounded-full");
        const size = Math.random() * 2 + 1; // 1px to 3px
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.top = `${Math.random() * 100}%`;
        star.style.left = `${Math.random() * 100}%`;
        starLayer.appendChild(star);
    }

    // parallax
    // document.addEventListener("mousemove", (e) => {
    //     const stars = document.querySelectorAll("#star-layer div");
    //     const { innerWidth, innerHeight } = window;
    //     const offsetX = (e.clientX / innerWidth - 0.5) * 20;
    //     const offsetY = (e.clientY / innerHeight - 0.5) * 20;

    //     stars.forEach((star, index) => {
    //         const speed = ((index % 3) + 1) * 0.2;
    //         star.style.transform = `translate(${offsetX * speed}px, ${
    //             offsetY * speed
    //         }px)`;
    //     });
    // });
});

// font weight slider
document.getElementById("weightSlider").addEventListener("input", (e) => {
    const w = e.target.value;
    localStorage.setItem("fontWeight", w);

    document.querySelector(
        ".variable-text"
    ).style.fontVariationSettings = `"wght" ${w}`;
});
document.addEventListener("DOMContentLoaded", () => {
    const saved = localStorage.getItem("fontWeight");

    if (saved) {
        const slider = document.getElementById("weightSlider");
        if (slider) slider.value = saved;

        document.querySelector(
            ".variable-text"
        ).style.fontVariationSettings = `"wght" ${saved}`;
    }
});

// Making the Light and Dark Mode button switch when clicked on.
const toggle = document.getElementById("themeToggle");
const root = document.documentElement;

if (localStorage.getItem("theme") === "dark") {
    root.classList.add("dark");
    toggle.textContent = "☀️";
}

toggle.addEventListener("click", () => {
    const isDark = root.classList.toggle("dark");
    toggle.textContent = isDark ? "☀️" : "🌙";
    localStorage.setItem("theme", isDark ? "dark" : "light");
});

document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("cursor-aura");

    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;

    const colours = ["#ff2bf5", "#ff5bff", "#00e5ff", "#2f8bff", "#8a4dff"];

    document.addEventListener("mousemove", (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    setInterval(() => {
        const pixel = document.createElement("span");

        const size = 4 + Math.random() * 4;
        pixel.style.width = size + "px";
        pixel.style.height = size + "px";

        const offsetX = (Math.random() - 0.5) * 40;
        const offsetY = (Math.random() - 0.5) * 40;

        pixel.style.left = mouseX + offsetX + "px";
        pixel.style.top = mouseY + offsetY + "px";

        const colour = colours[Math.floor(Math.random() * colours.length)];

        pixel.style.backgroundColor = colour;
        pixel.style.boxShadow = `0 0 14px ${colour}`;

        container.appendChild(pixel);

        setTimeout(() => {
            pixel.remove();
        }, 1800);
    }, 60);
});

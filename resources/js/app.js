import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// star background layer
document.addEventListener("DOMContentLoaded", () => {
    const starLayer = document.getElementById("star-layer");
    if (!starLayer) return;
    const starCount = 150;

    for (let i = 0; i < starCount; i++) {
        const star = document.createElement("div");
        const size = Math.random() * 2 + 1;

        star.className = "star";
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.top = `${Math.random() * 100}%`;
        star.style.left = `${Math.random() * 100}%`;

        star.style.opacity = Math.random() * 0.8 + 0.2;
        star.style.animationDuration = `${Math.random() * 15 + 2}s, ${
            Math.random() * 3 + 1
        }s`;
        starLayer.appendChild(star);
    }

    // mouse move parallax - too gimmicky ?

    // document.addEventListener("mousemove", (e) => {
    //     const stars = document.querySelectorAll("#star-layer div");
    //     const { innerWidth, innerHeight } = window;
    //     const offsetX = (e.clientX / innerWidth - 0.5) * 20; // adjust intensity
    //     const offsetY = (e.clientY / innerHeight - 0.5) * 20;

    //     stars.forEach((star, index) => {
    //         const speed = ((index % 3) + 1) * 0.2; // different speed per layer
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
    let lastX = mouseX;
    let lastY = mouseY;

    const colours = ["#ff2bf5", "#ff5bff", "#00e5ff", "#2f8bff", "#8a4dff"].map(
        (c) => c + "99"
    );

    document.addEventListener("mousemove", (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    setInterval(() => {
        if (mouseX === lastX && mouseY === lastY) return;
        lastX = mouseX;
        lastY = mouseY;

        const pixel = document.createElement("span");

        const size = 1 + Math.random() * 4; // dot size
        pixel.style.width = size + "px";
        pixel.style.height = size + "px";
        pixel.style.position = "fixed";
        pixel.style.pointerEvents = "none";
        pixel.style.borderRadius = "50%";
        pixel.style.opacity = 0.7;

        const offsetX = (Math.random() - 0.5) * 16; // spread
        const offsetY = (Math.random() - 0.5) * 16;

        pixel.style.left = mouseX + offsetX + "px";
        pixel.style.top = mouseY + offsetY + "px";

        const colour = colours[Math.floor(Math.random() * colours.length)];
        pixel.style.backgroundColor = colour;
        pixel.style.boxShadow = `0 0 6px ${colour}`;

        container.appendChild(pixel);

        setTimeout(() => pixel.remove(), 1500); // lifespan
    }, 30); // interval in ms
});

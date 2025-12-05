import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

// font weight slider

const weightSlider = document.getElementById("weightSlider");
if (weightSlider) {
    weightSlider.addEventListener("input", (e) => {
        const w = e.target.value;
        localStorage.setItem("fontWeight", w);
        document.querySelector(".variable-text").style.fontVariationSettings = `"wght" ${w}`;
    });
}

function loadFontWeight() {
    const saved = localStorage.getItem("fontWeight");
    if (saved) {
        const slider = document.getElementById("weightSlider");
        if (slider) slider.value = saved;
        document.querySelector(".variable-text").style.fontVariationSettings = `"wght" ${saved}`;
    }
}

// theme toggle

const toggle = document.getElementById("themeToggle");
const root = document.documentElement;

if (localStorage.getItem("theme") === "dark") {
    root.classList.add("dark");
    if (toggle) toggle.textContent = "☀️";
}

if (toggle) {
    toggle.addEventListener("click", () => {
        const isDark = root.classList.toggle("dark");
        toggle.textContent = isDark ? "☀️" : "🌙";
        localStorage.setItem("theme", isDark ? "dark" : "light");
    });
}

// star background layer

function animateStarLayer() {
    const starLayer = document.getElementById("star-layer");
    if (!starLayer) return;
    const starCount = 200;

    for (let i = 0; i < starCount; i++) {
        const star = document.createElement("div");
        const size = Math.random() * 2 + 1;
        star.className = "star";
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.top = `${Math.random() * 100}%`;
        star.style.left = `${Math.random() * 100}%`;
        star.style.opacity = Math.random() * 0.8 + 0.2;
        star.style.animationDuration = `${Math.random() * 15 + 2}s, ${Math.random() * 3 + 1}s`;
        starLayer.appendChild(star);
    }
}

// DOMContentLoaded

document.addEventListener("DOMContentLoaded", () => {
    loadFontWeight();
    animateStarLayer();

    const trailContainer = document.getElementById("mouse-trail");
    const cards = document.querySelectorAll(".product-card");

    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let lastX = mouseX;
    let lastY = mouseY;

    const trailColors = [
        "#ff2bf5",
        "#ff5bff",
        "#00e5ff",
        "#2f8bff",
        "#8a4dff",
    ];

    document.addEventListener("mousemove", (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    // mouse trail

    if (trailContainer) {
        setInterval(() => {
            if (mouseX === lastX && mouseY === lastY) return;
            lastX = mouseX;
            lastY = mouseY;

            const pixel = document.createElement("span");
            const size = 4 + Math.random() * 4;
            pixel.style.width = `${size}px`;
            pixel.style.height = `${size}px`;
            pixel.style.position = "fixed";
            pixel.style.pointerEvents = "none";
            pixel.style.borderRadius = "50%";

            const offsetX = (Math.random() - 0.5) * 40;
            const offsetY = (Math.random() - 0.5) * 40;

            pixel.style.left = `${mouseX + offsetX}px`;
            pixel.style.top = `${mouseY + offsetY}px`;

            const color = trailColors[Math.floor(Math.random() * trailColors.length)];
            pixel.style.backgroundColor = color;
            pixel.style.boxShadow = `0 0 14px ${color}`;

            trailContainer.appendChild(pixel);

            setTimeout(() => pixel.remove(), 1800);
        }, 60);
    }

    // card glow

    const localGlowRadius = 500; // px

    setInterval(() => {
        cards.forEach((card) => {
            const rect = card.getBoundingClientRect();
            const dx = Math.max(rect.left - mouseX, 0, mouseX - rect.right);
            const dy = Math.max(rect.top - mouseY, 0, mouseY - rect.bottom);
            const dist = Math.hypot(dx, dy);

            if (dist < localGlowRadius) {
                const px = mouseX - rect.left;
                const py = mouseY - rect.top;
                card.style.setProperty("--cursor-x", px + "px");
                card.style.setProperty("--cursor-y", py + "px");
                card.style.backgroundImage = `radial-gradient(circle at ${px}px ${py}px, rgba(47,139,255,0.2), transparent 60%)`;
                card.style.borderRadius = "8px";
            } else {
                card.style.backgroundImage = "";
            }
        });
    }, 30);
});

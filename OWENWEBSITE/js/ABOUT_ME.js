document.addEventListener('DOMContentLoaded', () => {
    const backgroundDots = document.querySelector('.background-dots');
    const numRows = Math.ceil(window.innerHeight / 20);
    const numCols = Math.ceil(window.innerWidth / 20);

    for (let i = 0; i < numRows; i++) {
        for (let j = 0; j < numCols; j++) {
            const dot = document.createElement('div');
            dot.className = 'dot';
            dot.style.top = `${i * 20}px`;
            dot.style.left = `${j * 20}px`;
            backgroundDots.appendChild(dot);
        }
    }

    document.body.addEventListener('mousemove', (e) => {
        document.querySelectorAll('.dot').forEach(dot => {
            const rect = dot.getBoundingClientRect();
            const distance = Math.hypot(rect.left + 1 - e.clientX, rect.top + 1 - e.clientY);
            if (distance < 60) {
                dot.style.backgroundColor = 'rgb(0, 0, 0)';
            } else {
                dot.style.backgroundColor = 'rgba(201, 201, 201, 0.308)';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const splashScreen = document.getElementById('splash-screen');
    const splashText = document.getElementById('splash-text');

    setTimeout(() => {
        splashText.textContent = 'OWEN DIGITAL RESUME';
        splashText.style.animation = 'none';
        void splashText.offsetWidth;
        splashText.style.animation = 'fadeInOut 4s ease-in-out';
    }, 2000);

    setTimeout(() => {
        splashScreen.style.opacity = '0';
    }, 4000);

    setTimeout(() => {
        splashScreen.style.display = 'none';
    }, 5000);
});
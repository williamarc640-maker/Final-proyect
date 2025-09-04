document.addEventListener('DOMContentLoaded', () => {
    const missionInteractive = document.getElementById('mission-interactive');
    const visionInteractive = document.getElementById('vision-interactive');

    // Mission interactive element
    missionInteractive.addEventListener('click', () => {
        const coreValues = [
            'Calidad', 'Versatilidad', 'Inovacion', 'Elegancia', 'Comodidad','Presencia'
        ];
        const currentText = missionInteractive.querySelector('span').textContent;
        
        if (currentText.includes('Click to reveal')) {
            missionInteractive.querySelector('span').textContent = coreValues.join(' • ');
            missionInteractive.querySelector('i').classList.remove('fa-bullseye');
            missionInteractive.querySelector('i').classList.add('fa-check');
        } else {
            missionInteractive.querySelector('span').textContent = 'Click to reveal our core values';
            missionInteractive.querySelector('i').classList.remove('fa-check');
            missionInteractive.querySelector('i').classList.add('fa-bullseye');
        }
    });

    // Vision interactive element
    visionInteractive.addEventListener('mouseenter', () => {
        const futureGoals = [
            'Expandirnos a nivel mundial',
            'Ser reconocido en todas las ciudades',
            'Brindar un excelente servicio a nuestros clientes',
            'Colaborar con diseñadores de renombre',
            'Tener la mejor calidad de nuestra era'
        ];
        visionInteractive.querySelector('span').innerHTML = futureGoals.map(goal => `<div>${goal}</div>`).join('');
        visionInteractive.querySelector('i').classList.remove('fa-binoculars');
        visionInteractive.querySelector('i').classList.add('fa-lightbulb');
    });

    visionInteractive.addEventListener('mouseleave', () => {
        visionInteractive.querySelector('span').textContent = 'Pasa el raton para ver nuestras metas';
        visionInteractive.querySelector('i').classList.remove('fa-lightbulb');
        visionInteractive.querySelector('i').classList.add('fa-binoculars');
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', () => {
        const hero = document.querySelector('.hero');
        const scrollPosition = window.pageYOffset;
        hero.style.backgroundPositionY = `${scrollPosition * 0.5}px`;
    });

    // Animate content sections on scroll
    const contentSections = document.querySelectorAll('.content-section');
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    contentSections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(section);
    });
});
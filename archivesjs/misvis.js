document.addEventListener('DOMContentLoaded', () => {
    const missionInteractive = document.getElementById('mission-interactive');
    const visionInteractive = document.getElementById('vision-interactive');

    // Mission interactive element
    missionInteractive.addEventListener('click', () => {
        const coreValues = [
            'Calidad', 'Versatilidad', 'Inovacion', 'Elegancia', 'Comodidad','Presencia'
        ];
        const currentText = missionInteractive.querySelector('span').textContent;
        
        if (currentText.includes('Click para revelar')) {
            missionInteractive.querySelector('span').textContent = coreValues.join(' • ');
            missionInteractive.querySelector('i').classList.remove('fa-bullseye');
            missionInteractive.querySelector('i').classList.add('fa-check');
        } else {
            missionInteractive.querySelector('span').textContent = 'Haz click para revelar nuestros valores';
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
});
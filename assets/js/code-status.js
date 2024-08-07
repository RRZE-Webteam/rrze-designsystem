document.addEventListener('DOMContentLoaded', function() {
    const accordions = document.querySelectorAll('.accordion-trigger');
    
    accordions.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', !isExpanded);
            
            const panel = trigger.nextElementSibling;
            if (panel) {
                if (isExpanded) {
                    panel.style.display = 'none';
                } else {
                    panel.style.display = 'block';
                }
            }
        });
    });
});
